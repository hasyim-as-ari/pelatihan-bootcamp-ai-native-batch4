<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel flight log (catatan penerbangan)
     * Mencatat realisasi penerbangan: jam take-off, jam landing,
     * durasi terbang aktual, dan evaluasi dari instruktur.
     */
    public function up(): void
    {
        Schema::create('flight_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_penerbangan_id')->constrained('jadwal_penerbangan')->cascadeOnDelete();
            $table->foreignId('taruna_id')->constrained('taruna')->cascadeOnDelete();
            $table->foreignId('instruktur_id')->constrained('instruktur')->cascadeOnDelete();
            $table->foreignId('pesawat_id')->constrained('pesawat')->cascadeOnDelete();
            $table->date('tanggal');
            $table->time('jam_takeoff')->nullable()->comment('Jam take-off aktual');
            $table->time('jam_landing')->nullable()->comment('Jam landing aktual');
            $table->decimal('durasi_terbang', 5, 2)->default(0)->comment('Durasi terbang aktual dalam jam (hours)');
            $table->enum('status', ['in_progress', 'completed', 'cancelled'])->default('in_progress');
            $table->text('catatan_evaluasi')->nullable()->comment('Catatan evaluasi penerbangan dari instruktur');
            $table->integer('nilai')->nullable()->comment('Nilai evaluasi 1-100');
            $table->enum('hasil_evaluasi', ['lulus', 'tidak_lulus', 'perlu_pengulangan'])->nullable();
            $table->string('kondisi_cuaca')->nullable()->comment('Kondisi cuaca saat penerbangan');
            $table->foreignId('recorded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_log');
    }
};
