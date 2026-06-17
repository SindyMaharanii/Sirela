<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lembaga;
use App\Models\Kategori;
use App\Models\User;

class LembagaController extends Controller
{
    private function cekVerifikasi()
    {
        if (Auth::check() && Auth::user()->role == 'lembaga' && Auth::user()->status_akun != 'aktif') {
            return redirect()->route('lembaga.index')->with('error', 'Akun belum diverifikasi');
        }
        return null;
    }

    public function index()
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    if (Auth::user()->role == 'admin') {
        $lembaga = Lembaga::with('kategori', 'user', 'informasi')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('lembaga.index', compact('lembaga'));
    } else {
        $lembaga = Lembaga::with('kategori', 'informasi')->where('pengguna_id', Auth::id())->first();
        return view('lembaga.index', compact('lembaga'));
    }
}

    public function create()
    {
        $redirect = $this->cekVerifikasi();
        if ($redirect) return $redirect;

        $existingLembaga = Lembaga::where('pengguna_id', Auth::id())->first();
        if ($existingLembaga) {
            return redirect()->route('lembaga.index')->with('error', 'Anda sudah memiliki profil lembaga');
        }
        
        $kategori = Kategori::all();
        return view('lembaga.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $redirect = $this->cekVerifikasi();
        if ($redirect) return $redirect;

        $request->validate([
            'nama_lembaga' => 'required|string|max:255',
        ]);

        $existingLembaga = Lembaga::where('pengguna_id', Auth::id())->first();
        if ($existingLembaga) {
            return redirect()->route('lembaga.index')->with('error', 'Anda sudah memiliki profil lembaga');
        }

        $lembaga = Lembaga::create([
            'pengguna_id' => Auth::id(),
            'nama_lembaga' => $request->nama_lembaga,
            'alamat' => $request->alamat,
            'lokasi' => $request->lokasi,
            'kontak' => $request->kontak,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'deskripsi' => $request->deskripsi,
        ]);

        if ($request->has('kategori_id')) {
            $lembaga->kategori()->attach($request->kategori_id);
        }

        return redirect()->route('dashboard')->with('success', 'Profil lembaga berhasil dibuat');
    }

    public function edit($id)
    {
        $redirect = $this->cekVerifikasi();
        if ($redirect) return $redirect;

        $lembaga = Lembaga::with('kategori')->findOrFail($id);
        
        if ($lembaga->pengguna_id != Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit lembaga ini');
        }
        
        $kategori = Kategori::all();
        return view('lembaga.edit', compact('lembaga', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $redirect = $this->cekVerifikasi();
        if ($redirect) return $redirect;

        $lembaga = Lembaga::findOrFail($id);
        
        if ($lembaga->pengguna_id != Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengupdate lembaga ini');
        }

        $lembaga->update([
            'nama_lembaga' => $request->nama_lembaga,
            'alamat' => $request->alamat,
            'lokasi' => $request->lokasi,
            'kontak' => $request->kontak,
            'visi' => $request->visi,
            'misi' => $request->misi,
            'deskripsi' => $request->deskripsi,
        ]);

        $lembaga->kategori()->sync($request->kategori_id ?? []);

        return redirect()->route('lembaga.index')->with('success', 'Profil lembaga berhasil diupdate');
    }

    
    public function destroy($id)
    {
        if (Auth::user()->role != 'admin') {
            abort(403, 'Hanya admin yang dapat menghapus lembaga');
        }
        
        $lembaga = Lembaga::findOrFail($id);
        $lembaga->delete();
        
        return redirect()->route('lembaga.index')->with('success', 'Lembaga berhasil dihapus');
    }
    
    public function show($id)
{
    $lembaga = Lembaga::with('kategori', 'user', 'informasi')->findOrFail($id);
    if ($lembaga->user && $lembaga->user->status_akun !== 'aktif') {
        return redirect('/')->with('error', 'Lembaga ini sedang tidak aktif.');
    }
    return view('public.show', compact('lembaga'));
}
}