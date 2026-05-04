<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Pilih jenis lembaga (WAJIB)
            $table->enum('jenis_lembaga', ['pemerintah', 'swasta', 'komunitas'])->nullable()->after('status_akun');
            
            // ========== FIELD UMUM SEMUA LEMBAGA (WAJIB) ==========
            $table->string('nama_lembaga')->nullable();
            $table->string('tahun_berdiri')->nullable();
            $table->text('alamat')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kota')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('telepon_lembaga')->nullable();
            $table->string('email_lembaga')->nullable();
            $table->string('website')->nullable(); // OPSIONAL
            
            // ========== UNTUK LEMBAGA PEMERINTAH (WAJIB) ==========
            $table->string('kementerian')->nullable();
            $table->string('eselon')->nullable();
            $table->string('nomor_sotk')->nullable();
            $table->string('nip_pimpinan')->nullable();
            $table->string('file_sotk')->nullable();
            
            // ========== UNTUK LEMBAGA SWASTA (WAJIB) ==========
            $table->string('tipe_swasta')->nullable();
            $table->string('nomor_akta')->nullable();
            $table->string('npwp_lembaga')->nullable();
            $table->string('nama_pimpinan')->nullable();
            $table->string('nik_pimpinan')->nullable();
            $table->string('rekening_lembaga')->nullable();
            $table->string('file_akta')->nullable();
            $table->string('file_npwp')->nullable();
            $table->string('file_ktp_pimpinan')->nullable();
            
            // ========== UNTUK KOMUNITAS (WAJIB) ==========
            $table->string('nomor_sk')->nullable();
            $table->date('tanggal_sk')->nullable();
            $table->string('nama_koordinator')->nullable();
            $table->string('nik_koordinator')->nullable();
            $table->string('rekening_komunitas')->nullable();
            $table->string('file_sk')->nullable();
            $table->string('file_ktp_koordinator')->nullable();
            
            $table->text('alasan_penolakan')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'jenis_lembaga', 'nama_lembaga', 'tahun_berdiri', 'alamat', 'provinsi',
                'kota', 'kode_pos', 'telepon_lembaga', 'email_lembaga', 'website',
                'kementerian', 'eselon', 'nomor_sotk', 'nip_pimpinan', 'file_sotk',
                'tipe_swasta', 'nomor_akta', 'npwp_lembaga', 'nama_pimpinan',
                'nik_pimpinan', 'rekening_lembaga', 'file_akta', 'file_npwp',
                'file_ktp_pimpinan', 'nomor_sk', 'tanggal_sk', 'nama_koordinator',
                'nik_koordinator', 'rekening_komunitas', 'file_sk', 'file_ktp_koordinator',
                'alasan_penolakan'
            ]);
        });
    }
};