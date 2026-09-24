<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Master data Rute dan Area Latihan Penerbangan
     */
    public function up(): void
    {
        Schema::create('rute_area_latihan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_rute')->unique()->nullable()->comment('Kode rute, contoh: W-1, W-2, XC-SUB');
            $table->string('nama_rute')->comment('Nama rute / area latihan');
            $table->string('kategori')->default('Area Latihan Lokal')->comment('Kategori: Area Latihan Lokal, Navigasi Cross Country, Sirkuit');
            $table->decimal('estimasi_durasi_jam', 4, 2)->default(1.50)->comment('Estimasi durasi jam terbang');
            $table->text('deskripsi')->nullable()->comment('Penjelasan detail area / rute latihan');
            $table->boolean('is_active')->default(true)->comment('Status keaktifan rute');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rute_area_latihan');
    }
};
