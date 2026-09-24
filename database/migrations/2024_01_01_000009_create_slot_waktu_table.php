<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel slot waktu penerbangan
     * Mendefinisikan slot-slot waktu yang tersedia untuk penjadwalan penerbangan
     * dalam satu hari. Admin Operasional dapat mengonfigurasi slot waktu ini.
     */
    public function up(): void
    {
        Schema::create('slot_waktu', function (Blueprint $table) {
            $table->id();
            $table->string('nama_slot')->comment('Nama slot: Pagi 1, Pagi 2, Siang 1, dst');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->decimal('durasi_jam', 5, 2)->comment('Durasi slot dalam jam');
            $table->boolean('is_active')->default(true);
            $table->integer('urutan')->default(0)->comment('Urutan tampilan slot');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slot_waktu');
    }
};
