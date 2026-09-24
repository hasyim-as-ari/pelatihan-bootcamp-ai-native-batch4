<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel pengaturan sistem
     * Menyimpan konfigurasi global sistem seperti batas jam terbang,
     * rest period, batas waktu pengajuan reschedule, dll.
     */
    public function up(): void
    {
        Schema::create('pengaturan_sistem', function (Blueprint $table) {
            $table->id();
            $table->string('kunci')->unique()->comment('Key pengaturan');
            $table->text('nilai')->comment('Value pengaturan');
            $table->string('tipe_data')->default('string')->comment('Tipe data: string, integer, decimal, boolean, json');
            $table->string('grup')->default('umum')->comment('Grup pengaturan: umum, jam_terbang, reschedule, notifikasi');
            $table->string('deskripsi')->nullable()->comment('Deskripsi pengaturan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaturan_sistem');
    }
};
