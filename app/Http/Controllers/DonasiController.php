<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\InformasiLembaga;
use App\Models\Lembaga;
use Illuminate\Support\Facades\Auth;

class DonasiController extends Controller
{
    // Menampilkan form donasi (via AJAX/modal)
    public function form(Request $request)
    {
        $informasiId = $request->informasi_id;
        $kebutuhanId = $request->kebutuhan_id;
        $kebutuhanNama = $request->kebutuhan_nama;
        $kebutuhanJenis = $request->kebutuhan_jenis;
        $satuan = $request->satuan;
        
        return view('donasi.form', compact('informasiId', 'kebutuhanId', 'kebutuhanNama', 'kebutuhanJenis', 'satuan'));
    }
    
    // Menyimpan donasi
    public function store(Request $request)
    {
        $request->validate([
            'informasi_id' => 'required',
            'lembaga_id' => 'required',
            'kebutuhan_id' => 'required',
            'kebutuhan_nama' => 'required',
            'kebutuhan_jenis' => 'required',
            'nama_donatur' => 'required|min:3',
            'no_hp' => 'required|min:10',
            'email' => 'nullable|email',
            'pesan' => 'nullable'
        ]);
        
        $donasi = Donasi::create([
            'informasi_id' => $request->informasi_id,
            'lembaga_id' => $request->lembaga_id,
            'kebutuhan_id' => $request->kebutuhan_id,
            'kebutuhan_nama' => $request->kebutuhan_nama,
            'kebutuhan_jenis' => $request->kebutuhan_jenis,
            'nama_donatur' => $request->nama_donatur,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'pesan' => $request->pesan,
            'jumlah_barang' => $request->kebutuhan_jenis == 'barang' ? $request->jumlah_barang : null,
            'satuan_barang' => $request->kebutuhan_jenis == 'barang' ? $request->satuan : null,
            'nominal_uang' => $request->kebutuhan_jenis == 'uang' ? $request->nominal_uang : null,
            'status' => 'pending'
        ]);
        
        return redirect()->back()->with('success', 'Terima kasih! Data donasi Anda telah dikirim. Lembaga akan menghubungi Anda segera.');
    }
    
    // Lembaga: lihat daftar donatur
    public function index()
    {
        $lembaga = Lembaga::where('pengguna_id', Auth::id())->first();
        
        if (!$lembaga) {
            return redirect()->route('lembaga.create')->with('error', 'Buat profil lembaga terlebih dahulu');
        }
        
        $donasi = Donasi::where('lembaga_id', $lembaga->lembaga_id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('donasi.index', compact('donasi'));
    }
    
    // Lembaga: konfirmasi donasi
    public function konfirmasi($id)
    {
        $donasi = Donasi::findOrFail($id);
        
        // Cek kepemilikan
        $lembaga = Lembaga::where('pengguna_id', Auth::id())->first();
        if ($donasi->lembaga_id != $lembaga->lembaga_id) {
            abort(403);
        }
        
        $donasi->status = 'dikonfirmasi';
        $donasi->save();
        
        // Update terkumpul di informasi lembaga
        $this->updateTerkumpul($donasi);
        
        return redirect()->back()->with('success', 'Donasi dikonfirmasi!');
    }
    
    // Update jumlah terkumpul di JSON kebutuhan_donasi_list
    private function updateTerkumpul($donasi)
    {
        $informasi = InformasiLembaga::find($donasi->informasi_id);
        $kebutuhanList = json_decode($informasi->kebutuhan_donasi_list, true);
        
        foreach ($kebutuhanList as &$kebutuhan) {
            if ($kebutuhan['id'] == $donasi->kebutuhan_id) {
                if ($donasi->kebutuhan_jenis == 'barang') {
                    $kebutuhan['terkumpul'] = ($kebutuhan['terkumpul'] ?? 0) + $donasi->jumlah_barang;
                } else {
                    $kebutuhan['terkumpul'] = ($kebutuhan['terkumpul'] ?? 0) + $donasi->nominal_uang;
                }
                
                // Update progress (opsional)
                $target = $kebutuhan['target'];
                $terkumpul = $kebutuhan['terkumpul'];
                $kebutuhan['progress'] = $target > 0 ? round(($terkumpul / $target) * 100, 2) : 0;
                break;
            }
        }
        
        $informasi->kebutuhan_donasi_list = json_encode($kebutuhanList, JSON_UNESCAPED_UNICODE);
        $informasi->tanggal_update = now();
        $informasi->save();
    }
    
    // Lembaga: update manual jumlah terkumpul
    public function updateTerkumpulManual(Request $request, $id)
    {
        $request->validate([
            'terkumpul_baru' => 'required|numeric|min:0'
        ]);
        
        $informasi = InformasiLembaga::findOrFail($id);
        
        // Cek kepemilikan
        $lembaga = Lembaga::where('pengguna_id', Auth::id())->first();
        if ($informasi->lembaga_id != $lembaga->lembaga_id) {
            abort(403);
        }
        
        $kebutuhanList = json_decode($informasi->kebutuhan_donasi_list, true);
        
        foreach ($kebutuhanList as &$kebutuhan) {
            if ($kebutuhan['id'] == $request->kebutuhan_id) {
                $kebutuhan['terkumpul'] = $request->terkumpul_baru;
                $target = $kebutuhan['target'];
                $terkumpul = $kebutuhan['terkumpul'];
                $kebutuhan['progress'] = $target > 0 ? round(($terkumpul / $target) * 100, 2) : 0;
                break;
            }
        }
        
        $informasi->kebutuhan_donasi_list = json_encode($kebutuhanList, JSON_UNESCAPED_UNICODE);
        $informasi->save();
        
        return redirect()->back()->with('success', 'Jumlah terkumpul berhasil diperbarui!');
    }
}