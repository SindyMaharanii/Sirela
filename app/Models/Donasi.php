<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    protected $table = 'donasi';
    protected $primaryKey = 'donasi_id';
    
    protected $fillable = [
        'informasi_id',
        'lembaga_id',
        'kebutuhan_id',
        'kebutuhan_nama',
        'kebutuhan_jenis',
        'nama_donatur',
        'no_hp',
        'email',
        'jumlah_barang',
        'satuan_barang',
        'nominal_uang',
        'pesan',
        'status'
    ];
    
    protected $casts = [
        'jumlah_barang' => 'decimal:2',
        'nominal_uang' => 'decimal:2'
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