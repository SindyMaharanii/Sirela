<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiLembaga extends Model
{
    protected $table = 'informasi_lembaga';
    protected $primaryKey = 'informasi_id';

    protected $fillable = [
        'lembaga_id',
        'jumlah_penerima_manfaat',
        'kebutuhan_donasi',
        'status_kolaborasi',
        'tanggal_update',
        'jumlah_anak_asuh',
        'rentang_usia',
        'profil_anak',
        'kebutuhan_donasi_list'
    ];

    protected $casts = [
        'kebutuhan_donasi_list' => 'array'
    ];

    public function lembaga()
    {
        return $this->belongsTo(Lembaga::class, 'lembaga_id', 'lembaga_id');
    }
}