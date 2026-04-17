<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('lembaga_kategori', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('lembaga_id');
        $table->unsignedBigInteger('kategori_id');
        $table->timestamps();
         $table->foreign('lembaga_id')
          ->references('lembaga_id')
          ->on('lembaga')
          ->onDelete('cascade');

    $table->foreign('kategori_id')
          ->references('kategori_id')
          ->on('kategori')
          ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lembaga_kategori');
    }
};
