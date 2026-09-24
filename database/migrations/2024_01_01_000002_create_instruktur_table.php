<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel data instruktur penerbang (Dosen / Instruktur Pilot)
     * Berisi data identitas instruktur, batasan jam terbang harian,
     * dan kualifikasi lisensi instruktur.
     */
    public function up(): void
    {
        Schema::create('instruktur', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('nidn')->unique()->comment('NIDN / ID Pilot instruktur');
            $table->string('nama');
            $table->string('no_telepon')->nullable();
            $table->string('lisensi')->nullable()->comment('Jenis lisensi pilot: CPL, ATPL, dll');
            $table->decimal('max_jam_terbang_harian', 5, 2)->default(8.00)->comment('Batasan jam terbang harian sesuai regulasi DGCA/DKPPU');
            $table->decimal('total_jam_terbang', 10, 2)->default(0)->comment('Akumulasi total jam terbang instruktur');
            $table->enum('status', ['aktif', 'cuti', 'nonaktif'])->default('aktif');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instruktur');
    }
};
