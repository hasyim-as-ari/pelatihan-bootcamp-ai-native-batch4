<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel jadwal penerbangan (flight schedule)
     * Merupakan tabel utama penjadwalan yang menghubungkan taruna, instruktur,
     * dan pesawat pada slot waktu tertentu. Termasuk rute/area latihan dan status penerbangan.
     * Status: draft, scheduled, in_flight, completed, cancelled, rescheduled
     */
    public function up(): void
    {
        Schema::create('jadwal_penerbangan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_jadwal')->unique()->comment('Kode unik jadwal: FLT-20240101-001');
            $table->date('tanggal')->index();
            $table->time('jam_mulai')->comment('Slot waktu mulai penerbangan');
            $table->time('jam_selesai')->comment('Slot waktu selesai penerbangan');
            $table->foreignId('taruna_id')->constrained('taruna')->cascadeOnDelete();
            $table->foreignId('instruktur_id')->constrained('instruktur')->cascadeOnDelete();
            $table->foreignId('pesawat_id')->constrained('pesawat')->cascadeOnDelete();
            $table->string('rute_area_latihan')->nullable()->comment('Rute atau area latihan penerbangan');
            $table->string('modul_penerbangan')->nullable()->comment('Modul/kurikulum yang dilatih: Navigation, Solo Flight, dll');
            $table->enum('status', [
                'draft',
                'scheduled',
                'in_flight',
                'completed',
                'cancelled',
                'rescheduled',
            ])->default('draft')->index();
            $table->text('catatan')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('published_at')->nullable()->comment('Waktu jadwal dipublikasikan');
            $table->timestamps();

            // Index untuk mencegah double-booking
            $table->index(['tanggal', 'jam_mulai', 'jam_selesai']);
            $table->index(['taruna_id', 'tanggal']);
            $table->index(['instruktur_id', 'tanggal']);
            $table->index(['pesawat_id', 'tanggal']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_penerbangan');
    }
};
