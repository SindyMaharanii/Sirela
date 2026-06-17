<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kebutuhan_donasi', function (Blueprint $table) {
            $table->id('kebutuhan_id');
            $table->unsignedBigInteger('informasi_id');
            $table->unsignedBigInteger('lembaga_id');
            $table->string('nama');
            $table->enum('jenis', ['barang', 'uang'])->default('barang');
            $table->decimal('target', 15, 2);
            $table->decimal('terkumpul', 15, 2)->default(0);
            $table->string('satuan')->nullable();
            $table->enum('prioritas', ['tinggi', 'sedang', 'rendah'])->default('sedang');
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->timestamps();
            
            $table->foreign('informasi_id')->references('informasi_id')->on('informasi_lembaga')->onDelete('cascade');
            $table->foreign('lembaga_id')->references('lembaga_id')->on('lembaga')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kebutuhan_donasi');
    }
};