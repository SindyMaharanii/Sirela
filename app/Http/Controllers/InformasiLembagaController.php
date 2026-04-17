<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InformasiLembaga;
use App\Models\Lembaga;

class InformasiLembagaController extends Controller
{
    // Cek status akun untuk aksi yang butuh verifikasi (create, edit, update, delete)
    private function cekVerifikasi()
    {
        if (auth()->user()->role == 'lembaga' && auth()->user()->status_akun != 'aktif') {
            return redirect()->route('lembaga.pending')->with('error', 'Akun belum diverifikasi, Anda tidak dapat menambah/mengubah data');
        }
        return null;
    }

    // INDEX - Bisa diakses semua (termasuk belum verifikasi)
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $informasi = InformasiLembaga::with('lembaga')->get();
        } else {
            $informasi = InformasiLembaga::with('lembaga')
                ->whereHas('lembaga', function ($q) {
                    $q->where('pengguna_id', auth()->id());
                })->get();
        }
        return view('informasi.index', compact('informasi'));
    }

    // CREATE - Hanya untuk yang sudah verifikasi
    public function create()
    {
        $redirect = $this->cekVerifikasi();
        if ($redirect) return $redirect;

        $lembaga = Lembaga::where('pengguna_id', auth()->id())->first();
        if (!$lembaga) {
            return redirect()->route('lembaga.create')->with('error', 'Silakan buat profil lembaga terlebih dahulu');
        }
        return view('informasi.create', compact('lembaga'));
    }

    // STORE - Hanya untuk yang sudah verifikasi
    public function store(Request $request)
    {
        $redirect = $this->cekVerifikasi();
        if ($redirect) return $redirect;

        $lembaga = Lembaga::where('pengguna_id', auth()->id())->first();

        $donasiList = [];
        if ($request->has('donasi_nama')) {
            for ($i = 0; $i < count($request->donasi_nama); $i++) {
                if (!empty($request->donasi_nama[$i])) {
                    $donasiList[] = [
                        'nama' => $request->donasi_nama[$i],
                        'jumlah' => $request->donasi_jumlah[$i] ?? '',
                        'satuan' => $request->donasi_satuan[$i] ?? 'unit'
                    ];
                }
            }
        }

        InformasiLembaga::updateOrCreate(
            ['lembaga_id' => $lembaga->lembaga_id],
            [
                'jumlah_anak_asuh' => $request->jumlah_anak_asuh,
                'rentang_usia' => $request->rentang_usia,
                'profil_anak' => $request->profil_anak,
                'kebutuhan_donasi_list' => json_encode($donasiList),
                'status_kolaborasi' => $request->status_kolaborasi,
                'tanggal_update' => now()
            ]
        );

        return redirect('/informasi')->with('success', 'Informasi berhasil disimpan');
    }

    // EDIT - Hanya untuk yang sudah verifikasi
    public function edit($id)
    {
        $redirect = $this->cekVerifikasi();
        if ($redirect) return $redirect;

        $informasi = InformasiLembaga::findOrFail($id);
        if (auth()->user()->role == 'lembaga' && $informasi->lembaga->pengguna_id != auth()->id()) {
            abort(403);
        }
        return view('informasi.edit', compact('informasi'));
    }

    // UPDATE - Hanya untuk yang sudah verifikasi
    public function update(Request $request, $id)
    {
        $redirect = $this->cekVerifikasi();
        if ($redirect) return $redirect;

        $informasi = InformasiLembaga::findOrFail($id);
        if (auth()->user()->role == 'lembaga' && $informasi->lembaga->pengguna_id != auth()->id()) {
            abort(403);
        }

        $donasiList = [];
        if ($request->has('donasi_nama')) {
            for ($i = 0; $i < count($request->donasi_nama); $i++) {
                if (!empty($request->donasi_nama[$i])) {
                    $donasiList[] = [
                        'nama' => $request->donasi_nama[$i],
                        'jumlah' => $request->donasi_jumlah[$i] ?? '',
                        'satuan' => $request->donasi_satuan[$i] ?? 'unit'
                    ];
                }
            }
        }

        $informasi->update([
            'jumlah_anak_asuh' => $request->jumlah_anak_asuh,
            'rentang_usia' => $request->rentang_usia,
            'profil_anak' => $request->profil_anak,
            'kebutuhan_donasi_list' => json_encode($donasiList),
            'status_kolaborasi' => $request->status_kolaborasi,
            'tanggal_update' => now()
        ]);

        return redirect('/informasi')->with('success', 'Informasi berhasil diupdate');
    }

    // SHOW - Bisa diakses semua (termasuk belum verifikasi)
    public function show($id)
    {
        $informasi = InformasiLembaga::with('lembaga')->where('lembaga_id', $id)->first();
        return view('informasi.show', compact('informasi'));
    }
}