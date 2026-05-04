<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Lembaga;
use App\Models\Kategori;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $rules = [
            // ========== AKUN LOGIN (WAJIB) ==========
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            
            // ========== JENIS LEMBAGA (WAJIB) ==========
            'jenis_lembaga' => ['required', 'in:pemerintah,swasta,komunitas'],
            
            // ========== DATA UMUM (WAJIB SEMUA) ==========
            'nama_lembaga' => 'required|string|max:255',
            'tahun_berdiri' => 'required|string|max:4',
            'alamat' => 'required|string',
            'provinsi' => 'required|string',
            'kota' => 'required|string',
            'kode_pos' => 'required|string|max:10',
            'telepon_lembaga' => 'required|string|max:20',
            'email_lembaga' => 'required|email',
            'website' => 'nullable|url',
            
            // ========== PERSETUJUAN (WAJIB) ==========
            'terms' => 'required',
        ];

        // ========== VALIDASI KHUSUS PEMERINTAH ==========
        if ($request->jenis_lembaga == 'pemerintah') {
            $rules['kementerian'] = 'required|string';
            $rules['eselon'] = 'required|string';
            $rules['nomor_sotk'] = 'required|string';
            $rules['nip_pimpinan'] = 'required|string';
            $rules['file_sotk'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:5120';
        }

        // ========== VALIDASI KHUSUS SWASTA ==========
        if ($request->jenis_lembaga == 'swasta') {
            $rules['tipe_swasta'] = 'required|in:Yayasan,Perkumpulan,LSM';
            $rules['nomor_akta'] = 'required|string';
            $rules['npwp_lembaga'] = 'required|string';
            $rules['nama_pimpinan'] = 'required|string';
            $rules['nik_pimpinan'] = 'required|string|size:16';
            $rules['rekening_lembaga'] = 'required|string';
            $rules['file_akta'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:5120';
            $rules['file_npwp'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:5120';
            $rules['file_ktp_pimpinan'] = 'required|image|mimes:jpg,jpeg,png|max:5120';
        }

        // ========== VALIDASI KHUSUS KOMUNITAS ==========
        if ($request->jenis_lembaga == 'komunitas') {
            $rules['nomor_sk'] = 'required|string';
            $rules['tanggal_sk'] = 'required|date';
            $rules['nama_koordinator'] = 'required|string';
            $rules['nik_koordinator'] = 'required|string|size:16';
            $rules['rekening_komunitas'] = 'required|string';
            $rules['file_sk'] = 'required|file|mimes:pdf,jpg,jpeg,png|max:5120';
            $rules['file_ktp_koordinator'] = 'required|image|mimes:jpg,jpeg,png|max:5120';
        }

        $request->validate($rules);

        // Upload file
        $data = [];
        
        if ($request->hasFile('file_sotk')) {
            $data['file_sotk'] = $request->file('file_sotk')->store('dokumen/sotk', 'public');
        }
        if ($request->hasFile('file_akta')) {
            $data['file_akta'] = $request->file('file_akta')->store('dokumen/akta', 'public');
        }
        if ($request->hasFile('file_npwp')) {
            $data['file_npwp'] = $request->file('file_npwp')->store('dokumen/npwp', 'public');
        }
        if ($request->hasFile('file_ktp_pimpinan')) {
            $data['file_ktp_pimpinan'] = $request->file('file_ktp_pimpinan')->store('dokumen/ktp', 'public');
        }
        if ($request->hasFile('file_sk')) {
            $data['file_sk'] = $request->file('file_sk')->store('dokumen/sk', 'public');
        }
        if ($request->hasFile('file_ktp_koordinator')) {
            $data['file_ktp_koordinator'] = $request->file('file_ktp_koordinator')->store('dokumen/ktp', 'public');
        }

        // ========== SIMPAN KE TABEL USERS ==========
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'lembaga',
            'status_akun' => 'nonaktif',
            'jenis_lembaga' => $request->jenis_lembaga,
            'nama_lembaga' => $request->nama_lembaga,
            'tahun_berdiri' => $request->tahun_berdiri,
            'alamat' => $request->alamat,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'kode_pos' => $request->kode_pos,
            'telepon_lembaga' => $request->telepon_lembaga,
            'email_lembaga' => $request->email_lembaga,
            'website' => $request->website,
        ];

        // Data khusus Pemerintah
        if ($request->jenis_lembaga == 'pemerintah') {
            $userData['kementerian'] = $request->kementerian;
            $userData['eselon'] = $request->eselon;
            $userData['nomor_sotk'] = $request->nomor_sotk;
            $userData['nip_pimpinan'] = $request->nip_pimpinan;
            $userData['file_sotk'] = $data['file_sotk'] ?? null;
        }

        // Data khusus Swasta
        if ($request->jenis_lembaga == 'swasta') {
            $userData['tipe_swasta'] = $request->tipe_swasta;
            $userData['nomor_akta'] = $request->nomor_akta;
            $userData['npwp_lembaga'] = $request->npwp_lembaga;
            $userData['nama_pimpinan'] = $request->nama_pimpinan;
            $userData['nik_pimpinan'] = $request->nik_pimpinan;
            $userData['rekening_lembaga'] = $request->rekening_lembaga;
            $userData['file_akta'] = $data['file_akta'] ?? null;
            $userData['file_npwp'] = $data['file_npwp'] ?? null;
            $userData['file_ktp_pimpinan'] = $data['file_ktp_pimpinan'] ?? null;
        }

        // Data khusus Komunitas
        if ($request->jenis_lembaga == 'komunitas') {
            $userData['nomor_sk'] = $request->nomor_sk;
            $userData['tanggal_sk'] = $request->tanggal_sk;
            $userData['nama_koordinator'] = $request->nama_koordinator;
            $userData['nik_koordinator'] = $request->nik_koordinator;
            $userData['rekening_komunitas'] = $request->rekening_komunitas;
            $userData['file_sk'] = $data['file_sk'] ?? null;
            $userData['file_ktp_koordinator'] = $data['file_ktp_koordinator'] ?? null;
        }

        $user = User::create($userData);

        // ========== OTOMATIS BUAT PROFIL DI TABEL LEMBAGA ==========
        Lembaga::create([
            'pengguna_id' => $user->id,
            'nama_lembaga' => $request->nama_lembaga,
            'alamat' => $request->alamat,
            'lokasi' => $request->kota, // Gunakan kota sebagai lokasi awal
            'kontak' => $request->telepon_lembaga,
            'visi' => null, // Bisa diisi nanti saat edit
            'misi' => null,
            'deskripsi' => null,
        ]);

        event(new Registered($user));

        return redirect('/login')->with('success', 'Pendaftaran berhasil! Akun Anda akan diverifikasi oleh admin terlebih dahulu.');
    }
}