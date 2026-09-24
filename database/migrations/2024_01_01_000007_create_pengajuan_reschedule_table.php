<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel pengajuan reschedule penerbangan
     * Digunakan oleh taruna atau instruktur untuk mengajukan perubahan jadwal
     * penerbangan karena alasan medis, cuaca buruk, atau hal mendesak lainnya.
     */
    public function up(): void
    {
        Schema::create('pengajuan_reschedule', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengajuan')->unique()->comment('Kode unik pengajuan: RSC-20240101-001');
            $table->foreignId('jadwal_penerbangan_id')->constrained('jadwal_penerbangan')->cascadeOnDelete();
            $table->foreignId('pemohon_id')->constrained('users')->cascadeOnDelete();
            $table->enum('tipe_pemohon', ['taruna', 'instruktur'])->comment('Tipe pemohon reschedule');

            // Jadwal awal
            $table->date('tanggal_awal');
            $table->time('jam_mulai_awal');
            $table->time('jam_selesai_awal');

            // Jadwal pengganti yang diusulkan
            $table->date('tanggal_pengganti');
            $table->time('jam_mulai_pengganti');
            $table->time('jam_selesai_pengganti');

            // Instruktur & pesawat pengganti (opsional, bisa tetap sama)
            $table->foreignId('instruktur_pengganti_id')->nullable()->constrained('instruktur')->nullOnDelete();
            $table->foreignId('pesawat_pengganti_id')->nullable()->constrained('pesawat')->nullOnDelete();

            // Alasan dan dokumen pendukung
            $table->enum('alasan_kategori', [
                'medis',
                'cuaca_buruk',
                'teknis_pesawat',
                'keperluan_mendesak',
                'lainnya',
            ])->comment('Kategori alasan perubahan jadwal');
            $table->text('alasan_detail')->comment('Penjelasan detail alasan perubahan');
            $table->string('dokumen_pendukung')->nullable()->comment('Path file dokumen pendukung (surat medis, laporan cuaca, dll)');

            // Status persetujuan
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->index();
            $table->text('catatan_admin')->nullable()->comment('Catatan persetujuan/penolakan dari Admin Operasional');
            $table->foreignId('diproses_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('diproses_pada')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_reschedule');
    }
};
