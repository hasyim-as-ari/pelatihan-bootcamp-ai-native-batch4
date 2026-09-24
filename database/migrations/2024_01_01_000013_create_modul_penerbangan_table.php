<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Master data Modul / Silabus Pelatihan Terbang
     */
    public function up(): void
    {
        Schema::create('modul_penerbangan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_modul')->unique()->nullable()->comment('Kode modul kurikulum, contoh: PPL-01, CPL-05');
            $table->string('nama_modul')->comment('Nama modul latihan penerbangan');
            $table->string('lisensi_target')->default('PPL')->comment('Lisensi target: PPL, CPL, IR, MER');
            $table->string('kategori')->nullable()->comment('Kategori manuver/latihan');
            $table->decimal('standar_jam_terbang', 4, 2)->default(1.50)->comment('Standar jam terbang per sesi modul');
            $table->text('deskripsi')->nullable()->comment('Sasaran pelatihan dan silabus modul');
            $table->boolean('is_active')->default(true)->comment('Status keaktifan modul');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modul_penerbangan');
    }
};
