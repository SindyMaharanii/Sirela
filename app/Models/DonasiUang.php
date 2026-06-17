<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonasiUang extends Model
{
    protected $table = 'donasi_uang';
    protected $primaryKey = 'donasi_id';
    
    protected $fillable = [
        'informasi_id',
        'lembaga_id',
        'kebutuhan_id',
        'kebutuhan_nama',
        'nama_donatur',
        'no_hp',
        'nama_rekening',
        'nama_bank',
        'bukti_transfer',
        'pesan',
        'nominal_uang',
        'status'
    ];
    
    public function informasi()
    {
        return $this->belongsTo(InformasiLembaga::class, 'informasi_id', 'informasi_id');
    }
    
    public function lembaga()
    {
        return $this->belongsTo(Lembaga::class, 'lembaga_id', 'lembaga_id');
    }
}