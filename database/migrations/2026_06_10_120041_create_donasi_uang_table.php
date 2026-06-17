<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('donasi_uang', function (Blueprint $table) {
            $table->id('donasi_id');
            $table->unsignedBigInteger('informasi_id');
            $table->unsignedBigInteger('lembaga_id');
            $table->string('kebutuhan_id');
            $table->string('kebutuhan_nama');
            $table->string('nama_donatur');
            $table->string('no_hp');
            $table->text('pesan')->nullable();
            $table->decimal('nominal_uang', 15, 2);
            $table->enum('status', ['pending', 'dikonfirmasi', 'selesai', 'batal'])->default('pending');
            $table->timestamps();
            
            $table->foreign('informasi_id')->references('informasi_id')->on('informasi_lembaga')->onDelete('cascade');
            $table->foreign('lembaga_id')->references('lembaga_id')->on('lembaga')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('donasi_uang');
    }
};