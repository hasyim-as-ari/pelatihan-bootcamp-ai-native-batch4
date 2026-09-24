<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Tabel pivot relasi many-to-many antara taruna dan modul penerbangan.
     * 1 taruna dapat mengambil 1 atau lebih modul penerbangan.
     */
    public function up(): void
    {
        Schema::create('taruna_modul_penerbangan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('taruna_id')->constrained('taruna')->cascadeOnDelete();
            $table->foreignId('modul_penerbangan_id')->constrained('modul_penerbangan')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['taruna_id', 'modul_penerbangan_id']);
        });

        // Migrasi data taruna yang sudah ada agar terhubung ke modul penerbangan sesuai lisensi
        $tarunas = DB::table('taruna')->get();
        foreach ($tarunas as $taruna) {
            if (!empty($taruna->modul_penerbangan)) {
                $modules = DB::table('modul_penerbangan')
                    ->where('lisensi_target', $taruna->modul_penerbangan)
                    ->get();

                foreach ($modules as $modul) {
                    DB::table('taruna_modul_penerbangan')->insertOrIgnore([
                        'taruna_id' => $taruna->id,
                        'modul_penerbangan_id' => $modul->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taruna_modul_penerbangan');
    }
};
