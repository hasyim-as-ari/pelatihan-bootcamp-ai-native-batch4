<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Seed data user sesuai 5 role pada PRD:
     * Super Admin, Admin Operasional, Instruktur, Taruna, Pimpinan
     */
    public function run(): void
    {
        // Super Admin - Staf IT / Unit Pengelola Data
        User::create([
            'name' => 'Admin Super',
            'email' => 'superadmin@api-banyuwangi.ac.id',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Admin Operasional - Staf Dispatch / FOO
        User::create([
            'name' => 'Ahmad Fauzi',
            'email' => 'admin.ops@api-banyuwangi.ac.id',
            'password' => Hash::make('password'),
            'role' => 'admin_operasional',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'admin.ops2@api-banyuwangi.ac.id',
            'password' => Hash::make('password'),
            'role' => 'admin_operasional',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Instruktur Penerbang - Dosen / Instruktur Pilot
        $instrukturUsers = [
            ['name' => 'Capt. Budi Santoso', 'email' => 'capt.budi@api-banyuwangi.ac.id'],
            ['name' => 'Capt. Rina Wulandari', 'email' => 'capt.rina@api-banyuwangi.ac.id'],
            ['name' => 'Capt. Hendra Gunawan', 'email' => 'capt.hendra@api-banyuwangi.ac.id'],
            ['name' => 'Capt. Dewi Sartika', 'email' => 'capt.dewi@api-banyuwangi.ac.id'],
            ['name' => 'Capt. Agus Prayitno', 'email' => 'capt.agus@api-banyuwangi.ac.id'],
        ];

        foreach ($instrukturUsers as $instruktur) {
            User::create([
                'name' => $instruktur['name'],
                'email' => $instruktur['email'],
                'password' => Hash::make('password'),
                'role' => 'instruktur',
                'is_active' => true,
                'email_verified_at' => now(),
            ]);
        }

        // Taruna / Taruni - Mahasiswa Penerbang
        $tarunaUsers = [
            ['name' => 'Muhammad Rizky Pratama', 'email' => 'rizky.pratama@taruna.api-banyuwangi.ac.id'],
            ['name' => 'Ayu Lestari', 'email' => 'ayu.lestari@taruna.api-banyuwangi.ac.id'],
            ['name' => 'Dimas Saputra', 'email' => 'dimas.saputra@taruna.api-banyuwangi.ac.id'],
            ['name' => 'Putri Ramadhani', 'email' => 'putri.ramadhani@taruna.api-banyuwangi.ac.id'],
            ['name' => 'Bayu Firmansyah', 'email' => 'bayu.firmansyah@taruna.api-banyuwangi.ac.id'],
            ['name' => 'Citra Dewi', 'email' => 'citra.dewi@taruna.api-banyuwangi.ac.id'],
            ['name' => 'Fajar Nugroho', 'email' => 'fajar.nugroho@taruna.api-banyuwangi.ac.id'],
            ['name' => 'Indah Permatasari', 'email' => 'indah.permatasari@taruna.api-banyuwangi.ac.id'],
            ['name' => 'Kevin Anggara', 'email' => 'kevin.anggara@taruna.api-banyuwangi.ac.id'],
            ['name' => 'Nabila Azzahra', 'email' => 'nabila.azzahra@taruna.api-banyuwangi.ac.id'],
        ];

        foreach ($tarunaUsers as $taruna) {
            User::create([
                'name' => $taruna['name'],
                'email' => $taruna['email'],
                'password' => Hash::make('password'),
                'role' => 'taruna',
                'is_active' => true,
                'email_verified_at' => now(),
            ]);
        }

        // Pimpinan - Kepala Pusat Operasional / Direktur
        User::create([
            'name' => 'Dr. Ir. Surya Atmaja, M.T.',
            'email' => 'direktur@api-banyuwangi.ac.id',
            'password' => Hash::make('password'),
            'role' => 'pimpinan',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Ir. Bambang Suryanto, M.M.',
            'email' => 'kaops@api-banyuwangi.ac.id',
            'password' => Hash::make('password'),
            'role' => 'pimpinan',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
    }
}
