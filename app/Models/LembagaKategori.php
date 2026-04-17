<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LembagaKategori extends Model
{
    protected $table = 'lembaga_kategori';

    protected $fillable = [
        'lembaga_id',
        'kategori_id'
    ];
}