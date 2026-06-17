<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonasiBarang extends Model
{
    protected $table = 'donasi_barang';
    protected $primaryKey = 'donasi_id';
    
    protected $fillable = [
        'informasi_id',
        'lembaga_id',
        'kebutuhan_id',
        'kebutuhan_nama',
        'nama_donatur',
        'no_hp',
        'pesan',
        'jumlah_barang',
        'satuan_barang',
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