<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status_akun',
        // Field lembaga
        'jenis_lembaga',
        'nama_lembaga',
        'tahun_berdiri',
        'alamat',
        'provinsi',
        'kota',
        'kode_pos',
        'telepon_lembaga',
        'email_lembaga',
        'website',
        // Pemerintah
        'kementerian',
        'eselon',
        'nomor_sotk',
        'nip_pimpinan',
        'file_sotk',
        // Swasta
        'tipe_swasta',
        'nomor_akta',
        'npwp_lembaga',
        'nama_pimpinan',
        'nik_pimpinan',
        'rekening_lembaga',
        'file_akta',
        'file_npwp',
        'file_ktp_pimpinan',
        // Komunitas
        'nomor_sk',
        'tanggal_sk',
        'nama_koordinator',
        'nik_koordinator',
        'rekening_komunitas',
        'file_sk',
        'file_ktp_koordinator',
        'alasan_penolakan',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function lembaga()
    {
        return $this->hasOne(Lembaga::class, 'pengguna_id');
    }
}