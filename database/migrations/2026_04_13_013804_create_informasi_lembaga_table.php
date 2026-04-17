<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('informasi_lembaga', function (Blueprint $table) {
            $table->id('informasi_id');
            $table->unsignedBigInteger('lembaga_id');
            $table->integer('jumlah_anak_asuh')->nullable();
            $table->string('rentang_usia')->nullable();
            $table->text('profil_anak')->nullable();
            $table->json('kebutuhan_donasi_list')->nullable();
            $table->string('status_kolaborasi')->nullable();
            $table->date('tanggal_update')->nullable();
            $table->timestamps();
            
            $table->foreign('lembaga_id')
                  ->references('lembaga_id')
                  ->on('lembaga')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('informasi_lembaga');
    }
};