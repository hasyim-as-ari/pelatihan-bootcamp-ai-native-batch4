<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel notifikasi untuk mengirim pemberitahuan real-time
     * ke pengguna terkait perubahan jadwal, pengajuan reschedule,
     * peringatan batas jam terbang, dan pengumuman lainnya.
     */
    public function up(): void
    {
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('judul');
            $table->text('pesan');
            $table->enum('tipe', [
                'jadwal_baru',
                'jadwal_berubah',
                'jadwal_dibatalkan',
                'reschedule_diajukan',
                'reschedule_disetujui',
                'reschedule_ditolak',
                'peringatan_jam_terbang',
                'peringatan_maintenance',
                'pengumuman',
            ]);
            $table->string('tautan')->nullable()->comment('URL terkait notifikasi');
            $table->boolean('dibaca')->default(false);
            $table->timestamp('dibaca_pada')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'dibaca']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};
