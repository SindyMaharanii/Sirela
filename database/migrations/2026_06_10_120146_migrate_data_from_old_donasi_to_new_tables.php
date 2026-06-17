<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Cek apakah tabel donasi lama ada
        if (!Schema::hasTable('donasi')) {
            return;
        }
        
        // Ambil semua data dari tabel donasi lama
        $donasiLama = DB::table('donasi')->get();
        
        foreach ($donasiLama as $donasi) {
            if ($donasi->kebutuhan_jenis == 'barang') {
                // Pindahkan ke donasi_barang
                DB::table('donasi_barang')->insert([
                    'donasi_id' => $donasi->donasi_id,
                    'informasi_id' => $donasi->informasi_id,
                    'lembaga_id' => $donasi->lembaga_id,
                    'kebutuhan_id' => $donasi->kebutuhan_id,
                    'kebutuhan_nama' => $donasi->kebutuhan_nama,
                    'nama_donatur' => $donasi->nama_donatur,
                    'no_hp' => $donasi->no_hp,
                    'email' => $donasi->email,
                    'pesan' => $donasi->pesan,
                    'jumlah_barang' => $donasi->jumlah_barang,
                    'satuan_barang' => $donasi->satuan_barang,
                    'status' => $donasi->status,
                    'created_at' => $donasi->created_at,
                    'updated_at' => $donasi->updated_at,
                ]);
            } else {
                // Pindahkan ke donasi_uang
                DB::table('donasi_uang')->insert([
                    'donasi_id' => $donasi->donasi_id,
                    'informasi_id' => $donasi->informasi_id,
                    'lembaga_id' => $donasi->lembaga_id,
                    'kebutuhan_id' => $donasi->kebutuhan_id,
                    'kebutuhan_nama' => $donasi->kebutuhan_nama,
                    'nama_donatur' => $donasi->nama_donatur,
                    'no_hp' => $donasi->no_hp,
                    'email' => $donasi->email,
                    'pesan' => $donasi->pesan,
                    'nominal_uang' => $donasi->nominal_uang,
                    'status' => $donasi->status,
                    'created_at' => $donasi->created_at,
                    'updated_at' => $donasi->updated_at,
                ]);
            }
        }
    }

    public function down()
    {
        // Hapus semua data yang sudah dipindahkan (opsional)
        DB::table('donasi_barang')->truncate();
        DB::table('donasi_uang')->truncate();
    }
};