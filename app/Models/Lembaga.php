<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lembaga extends Model
{
    protected $table = 'lembaga';
    protected $primaryKey = 'lembaga_id';

    protected $fillable = [
        'pengguna_id',
        'nama_lembaga',
        'alamat',
        'lokasi',
        'kontak',
        'visi',
        'misi',
        'deskripsi'
    ];

    public function kategori()
    {
        return $this->belongsToMany(
            Kategori::class,
            'lembaga_kategori',
            'lembaga_id',
            'kategori_id'
        );
    }

    public function informasi()
    {
        return $this->hasOne(
            InformasiLembaga::class,
            'lembaga_id',
            'lembaga_id'
        );
    }

    public function user()
{
    return $this->belongsTo(User::class, 'pengguna_id');
}

}