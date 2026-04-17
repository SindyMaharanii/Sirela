<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lembaga;
use App\Models\Kategori;
use App\Models\User;

class LembagaController extends Controller
{
    // Cek status akun (hanya untuk lembaga)
    private function cekVerifikasi()
    {
        if (Auth::user()->role == 'lembaga' && Auth::user()->status_akun != 'aktif') {
            return redirect()->route('lembaga.pending')->with('error', 'Akun belum diverifikasi');
        }
        return null;
    }

    // Admin: lihat semua lembaga
    // Lembaga: lihat hanya lembaga miliknya sendiri
    public function index()
    {
        // Cek verifikasi untuk lembaga
        $redirect = $this->cekVerifikasi();
        if ($redirect) return $redirect;

        if (Auth::user()->role == 'admin') {
            $lembaga = Lembaga::with('kategori', 'user', 'informasi')->get();
            return view('lembaga.index-admin', compact('lembaga'));
        } else {
            $lembaga = Lembaga::with('kategori', 'informasi')
                ->where('pengguna_id', Auth::id())
                ->get();
            return view('lembaga.index', compact('lembaga'));
        }
    }

    // HANYA lembaga yang bisa create (setelah login)
    public function create()
    {
        // Cek verifikasi
        $redirect = $this->cekVerifikasi();
        if ($redirect) return $redirect;

        // Cek apakah lembaga ini sudah punya profil?
        $existingLembaga = Lembaga::where('pengguna_id', Auth::id())->first();
        if ($existingLembaga) {
            return redirect()->route('lembaga.index')->with('error', 'Anda sudah memiliki profil lembaga');
        }
        
        $kategori = Kategori::all();
        return view('lembaga.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        // Cek verifikasi
        $redirect = $this->cekVerifikasi();
        if ($redirect) return $redirect;

        $request->validate([
            'nama_lembaga' => 'required|string|max:255',
            'alamat' => 'nullable',
            'lokasi' => 'nullable',
            'kontak' => 'nullable',
            'kategori_id' => 'array',
        ]);

        // Cek lagi apakah sudah punya profil
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

        return redirect()->route('lembaga.index')->with('success', 'Profil lembaga berhasil dibuat');
    }

    // Edit hanya untuk lembaga yang punya profil ini
    public function edit($id)
    {
        // Cek verifikasi
        $redirect = $this->cekVerifikasi();
        if ($redirect) return $redirect;

        $lembaga = Lembaga::with('kategori')->findOrFail($id);
        
        // Hanya pemilik lembaga yang bisa edit
        if ($lembaga->pengguna_id != Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit lembaga ini');
        }
        
        $kategori = Kategori::all();
        return view('lembaga.edit', compact('lembaga', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        // Cek verifikasi
        $redirect = $this->cekVerifikasi();
        if ($redirect) return $redirect;

        $lembaga = Lembaga::findOrFail($id);
        
        // Hanya pemilik lembaga yang bisa update
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

    // Hanya admin yang bisa hapus
    public function destroy($id)
    {
        // Hanya admin yang bisa menghapus lembaga
        if (Auth::user()->role != 'admin') {
            abort(403, 'Hanya admin yang dapat menghapus lembaga');
        }
        
        $lembaga = Lembaga::findOrFail($id);
        $lembaga->delete();
        
        return redirect()->route('lembaga.index')->with('success', 'Lembaga berhasil dihapus');
    }

    // Show untuk public dan internal
    public function show($id)
    {
        $lembaga = Lembaga::with('kategori', 'informasi')->findOrFail($id);
        return view('lembaga.show', compact('lembaga'));
    }
}