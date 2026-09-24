<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * Urutan seeder penting karena ada dependensi foreign key:
     * 1. Users (akun login untuk semua peran)
     * 2. Instruktur & Taruna (profil detail, FK ke users)
     * 3. Pesawat (armada latih)
     * 4. SlotWaktu (slot penerbangan)
     * 5. PengaturanSistem (konfigurasi global)
     * 6. JadwalPenerbangan (FK ke taruna, instruktur, pesawat)
     * 7. FlightLog (FK ke jadwal_penerbangan)
     * 8. PengajuanReschedule (FK ke jadwal_penerbangan, users)
     * 9. Notifikasi (FK ke users)
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RuteAreaLatihanSeeder::class,
            ModulPenerbanganSeeder::class,
            InstrukturSeeder::class,
            TarunaSeeder::class,
            PesawatSeeder::class,
            SlotWaktuSeeder::class,
            PengaturanSistemSeeder::class,
            JadwalPenerbanganSeeder::class,
            FlightLogSeeder::class,
            PengajuanRescheduleSeeder::class,
            NotifikasiSeeder::class,
        ]);
    }
}
