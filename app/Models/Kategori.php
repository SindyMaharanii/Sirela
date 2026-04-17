<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Lembaga;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'kategori_id';

    protected $fillable = [
        'nama_kategori'
    ];

    public function lembaga()
    {
        return $this->belongsToMany(
            Lembaga::class,
            'lembaga_kategori',
            'kategori_id',
            'lembaga_id'
        );
    }
}