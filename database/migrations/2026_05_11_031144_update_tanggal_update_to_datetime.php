<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('informasi_lembaga', function (Blueprint $table) {
            $table->dateTime('tanggal_update')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('informasi_lembaga', function (Blueprint $table) {
            $table->date('tanggal_update')->nullable()->change();
        });
    }
};