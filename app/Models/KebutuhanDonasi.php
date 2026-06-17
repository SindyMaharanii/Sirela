<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KebutuhanDonasi extends Model
{
    protected $table = 'kebutuhan_donasi';
    protected $primaryKey = 'kebutuhan_id';
    
    protected $fillable = [
        'informasi_id',
        'lembaga_id',
        'nama',
        'jenis',
        'target',
        'terkumpul',
        'satuan',
        'prioritas',
        'status'
    ];
    
    protected $casts = [
        'target' => 'decimal:2',
        'terkumpul' => 'decimal:2'
    ];
    
    public function informasiLembaga()
    {
        return $this->belongsTo(InformasiLembaga::class, 'informasi_id', 'informasi_id');
    }
    
    public function lembaga()
    {
        return $this->belongsTo(Lembaga::class, 'lembaga_id', 'lembaga_id');
    }
    
    public function donasi()
    {
        return $this->hasMany(Donasi::class, 'kebutuhan_id', 'kebutuhan_id');
    }
}