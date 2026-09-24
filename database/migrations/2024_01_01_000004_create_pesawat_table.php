<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel data armada pesawat
     * Berisi data registrasi pesawat, tipe, status kelayakan, dan jam terbang airframe.
     * Pesawat dengan status maintenance otomatis diabaikan dari penjadwalan.
     */
    public function up(): void
    {
        Schema::create('pesawat', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_registrasi')->unique()->comment('Nomor registrasi pesawat (tail number)');
            $table->string('tipe_pesawat')->comment('Tipe/model pesawat: Cessna 172, PA-28, dll');
            $table->string('nama_pesawat')->nullable()->comment('Nama panggilan/callsign pesawat');
            $table->decimal('total_jam_terbang', 10, 2)->default(0)->comment('Total airframe hours');
            $table->decimal('jam_terbang_sebelum_maintenance', 10, 2)->default(100)->comment('Jam terbang sebelum perlu maintenance berikutnya');
            $table->enum('status', ['available', 'in_use', 'maintenance', 'grounded'])->default('available')->comment('Status kelayakan armada');
            $table->date('tanggal_maintenance_terakhir')->nullable();
            $table->date('tanggal_maintenance_berikutnya')->nullable();
            $table->integer('kapasitas_penumpang')->default(2)->comment('Kapasitas (instruktur + taruna)');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesawat');
    }
};
