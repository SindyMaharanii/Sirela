<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lembaga', function (Blueprint $table) {
            $table->id('lembaga_id');
            $table->foreignId('pengguna_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_lembaga');
            $table->text('alamat')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('kontak')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lembaga');
    }
};