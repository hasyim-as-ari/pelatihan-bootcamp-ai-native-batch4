<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel data taruna/taruni (mahasiswa penerbang)
     * Berisi data NIM, nama, akumulasi jam terbang, status lisensi/modul,
     * dan kuota jam terbang yang dimiliki taruna.
     */
    public function up(): void
    {
        Schema::create('taruna', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('nim')->unique()->comment('Nomor Induk Mahasiswa');
            $table->string('nama');
            $table->string('no_telepon')->nullable();
            $table->string('angkatan')->nullable()->comment('Angkatan taruna');
            $table->string('modul_penerbangan')->nullable()->comment('Status lisensi/modul yang sedang diambil: PPL, CPL, IR, dll');
            $table->decimal('total_jam_terbang', 10, 2)->default(0)->comment('Akumulasi total jam terbang taruna');
            $table->decimal('kuota_jam_terbang', 10, 2)->default(0)->comment('Total kuota jam terbang yang dimiliki taruna');
            $table->decimal('sisa_kuota_jam_terbang', 10, 2)->default(0)->comment('Sisa kuota jam terbang yang belum terpakai');
            $table->decimal('max_jam_terbang_harian', 5, 2)->default(4.00)->comment('Batasan jam terbang harian taruna sesuai regulasi');
            $table->enum('status', ['aktif', 'cuti', 'lulus', 'nonaktif'])->default('aktif');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taruna');
    }
};
