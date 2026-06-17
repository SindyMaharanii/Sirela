<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonasiBarang;
use App\Models\DonasiUang;
use App\Models\InformasiLembaga;
use App\Models\Lembaga;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DonasiController extends Controller
{
    public function index()
{
    $lembaga = Lembaga::where('pengguna_id', Auth::id())->first();
    
    if (!$lembaga) {
        return redirect()->route('lembaga.create')->with('error', 'Buat profil lembaga terlebih dahulu');
    }
    
    $donasiBarang = DonasiBarang::where('lembaga_id', $lembaga->lembaga_id)
        ->orderBy('created_at', 'desc')  // ← SUDAH BENAR (terbaru di atas)
        ->get();
        
    $donasiUang = DonasiUang::where('lembaga_id', $lembaga->lembaga_id)
        ->orderBy('created_at', 'desc')  // ← SUDAH BENAR (terbaru di atas)
        ->get();
    
    return view('donasi.index', compact('donasiBarang', 'donasiUang'));
}
    
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
            'pesan' => 'nullable'
        ]);
        
        if ($request->kebutuhan_jenis == 'barang') {
            $request->validate([
                'jumlah_barang' => 'required',
                'satuan' => 'required'
            ]);
            
            $jumlahBarang = str_replace('.', '', $request->jumlah_barang);
            
            DonasiBarang::create([
                'informasi_id' => $request->informasi_id,
                'lembaga_id' => $request->lembaga_id,
                'kebutuhan_id' => $request->kebutuhan_id,
                'kebutuhan_nama' => $request->kebutuhan_nama,
                'nama_donatur' => $request->nama_donatur,
                'no_hp' => $request->no_hp,
                'pesan' => $request->pesan,
                'jumlah_barang' => $jumlahBarang,
                'satuan_barang' => $request->satuan,
                'status' => 'pending'
            ]);
        } else {
            $request->validate([
                'nominal_uang' => 'required',
                'bukti_transfer' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
            ]);
            
            $nominalUang = str_replace('.', '', $request->nominal_uang);
            
            // Upload bukti transfer
            $buktiTransfer = null;
            if ($request->hasFile('bukti_transfer')) {
                $file = $request->file('bukti_transfer');
                $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9.]/', '_', $file->getClientOriginalName());
                $buktiTransfer = $file->storeAs('bukti_transfer', $filename, 'public');
            }
            
            DonasiUang::create([
                'informasi_id' => $request->informasi_id,
                'lembaga_id' => $request->lembaga_id,
                'kebutuhan_id' => $request->kebutuhan_id,
                'kebutuhan_nama' => $request->kebutuhan_nama,
                'nama_donatur' => $request->nama_donatur,
                'no_hp' => $request->no_hp,
                'nama_rekening' => $request->nama_rekening,
                'nama_bank' => $request->nama_bank,
                'bukti_transfer' => $buktiTransfer,
                'pesan' => $request->pesan,
                'nominal_uang' => $nominalUang,
                'status' => 'pending'
            ]);
        }
        
        return redirect()->back()->with('success', 'Terima kasih! Data donasi Anda telah dikirim.');
    }
    
    public function konfirmasiBarang($id)
    {
        $donasi = DonasiBarang::findOrFail($id);
        
        $lembaga = Lembaga::where('pengguna_id', Auth::id())->first();
        if ($donasi->lembaga_id != $lembaga->lembaga_id) {
            abort(403);
        }
        
        $donasi->status = 'dikonfirmasi';
        $donasi->save();
        
        $this->updateTerkumpulBarang($donasi);
        
        return redirect()->back()->with('success', 'Donasi barang dikonfirmasi!');
    }
    
    public function konfirmasiUang($id)
    {
        $donasi = DonasiUang::findOrFail($id);
        
        $lembaga = Lembaga::where('pengguna_id', Auth::id())->first();
        if ($donasi->lembaga_id != $lembaga->lembaga_id) {
            abort(403);
        }
        
        $donasi->status = 'dikonfirmasi';
        $donasi->save();
        
        $this->updateTerkumpulUang($donasi);
        
        return redirect()->back()->with('success', 'Donasi uang dikonfirmasi!');
    }
    
    private function updateTerkumpulBarang($donasi)
{
    $informasi = InformasiLembaga::find($donasi->informasi_id);
    
    if (!$informasi) {
        \Log::error('Informasi lembaga tidak ditemukan untuk donasi_id: ' . $donasi->donasi_id);
        return;
    }
    
    $kebutuhanList = $informasi->kebutuhan_donasi_list;
    
    if (is_string($kebutuhanList)) {
        $kebutuhanList = json_decode($kebutuhanList, true);
    }
    if (!is_array($kebutuhanList)) {
        $kebutuhanList = [];
    }
    
    $updated = false;
    foreach ($kebutuhanList as $index => &$kebutuhan) {
        if (isset($kebutuhan['id']) && (string)$kebutuhan['id'] == (string)$donasi->kebutuhan_id) {
            $oldTerkumpul = $kebutuhan['terkumpul'] ?? 0;
            $kebutuhan['terkumpul'] = $oldTerkumpul + $donasi->jumlah_barang;
            $updated = true;
            break;
        }
    }
    
    if ($updated) {
        $informasi->kebutuhan_donasi_list = json_encode($kebutuhanList, JSON_UNESCAPED_UNICODE);
        $informasi->tanggal_update = now();
        $informasi->save();
        \Log::info('Berhasil update terkumpul barang');
    } else {
        \Log::warning('Kebutuhan tidak ditemukan untuk ID: ' . $donasi->kebutuhan_id);
    }
}
    
   private function updateTerkumpulUang($donasi)
{
    $informasi = InformasiLembaga::find($donasi->informasi_id);
    
    if (!$informasi) {
        \Log::error('Informasi lembaga tidak ditemukan untuk donasi_id: ' . $donasi->donasi_id);
        return;
    }
    
    $kebutuhanList = $informasi->kebutuhan_donasi_list;
    
    // Pastikan dalam bentuk array
    if (is_string($kebutuhanList)) {
        $kebutuhanList = json_decode($kebutuhanList, true);
    }
    if (!is_array($kebutuhanList)) {
        $kebutuhanList = [];
    }
    
    // Debug: cek ID yang dicari
    \Log::info('Mencari kebutuhan_id: ' . $donasi->kebutuhan_id);
    
    $updated = false;
    foreach ($kebutuhanList as $index => &$kebutuhan) {
        // Pastikan ID dibandingkan sebagai string
        if (isset($kebutuhan['id']) && (string)$kebutuhan['id'] == (string)$donasi->kebutuhan_id) {
            $oldTerkumpul = $kebutuhan['terkumpul'] ?? 0;
            $kebutuhan['terkumpul'] = $oldTerkumpul + $donasi->nominal_uang;
            \Log::info('Update terkumpul dari ' . $oldTerkumpul . ' menjadi ' . $kebutuhan['terkumpul']);
            $updated = true;
            break;
        }
    }
    
    if ($updated) {
        $informasi->kebutuhan_donasi_list = json_encode($kebutuhanList, JSON_UNESCAPED_UNICODE);
        $informasi->tanggal_update = now();
        $informasi->save();
        \Log::info('Berhasil menyimpan update ke database');
    } else {
        \Log::warning('Kebutuhan tidak ditemukan untuk ID: ' . $donasi->kebutuhan_id);
        \Log::warning('Daftar ID yang tersedia: ' . json_encode(array_column($kebutuhanList, 'id')));
    }
}
    
    public function form(Request $request)
    {
        $informasiId = $request->informasi_id;
        $kebutuhanId = $request->kebutuhan_id;
        $kebutuhanNama = $request->kebutuhan_nama;
        $kebutuhanJenis = $request->kebutuhan_jenis;
        $satuan = $request->satuan;
        
        return view('donasi.form', compact('informasiId', 'kebutuhanId', 'kebutuhanNama', 'kebutuhanJenis', 'satuan'));
    }
}