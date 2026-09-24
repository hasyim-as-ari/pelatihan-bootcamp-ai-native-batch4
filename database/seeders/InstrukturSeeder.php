<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Instruktur;

class InstrukturSeeder extends Seeder
{
    /**
     * Seed data instruktur penerbang.
     * Setiap instruktur terhubung ke user account dengan role 'instruktur'.
     */
    public function run(): void
    {
        $instrukturData = [
            [
                'email' => 'capt.budi@api-banyuwangi.ac.id',
                'nidn' => 'INS-001',
                'nama' => 'Capt. Budi Santoso',
                'no_telepon' => '081234567001',
                'lisensi' => 'ATPL',
                'max_jam_terbang_harian' => 8.00,
                'total_jam_terbang' => 4500.50,
                'status' => 'aktif',
            ],
            [
                'email' => 'capt.rina@api-banyuwangi.ac.id',
                'nidn' => 'INS-002',
                'nama' => 'Capt. Rina Wulandari',
                'no_telepon' => '081234567002',
                'lisensi' => 'CPL',
                'max_jam_terbang_harian' => 8.00,
                'total_jam_terbang' => 3200.75,
                'status' => 'aktif',
            ],
            [
                'email' => 'capt.hendra@api-banyuwangi.ac.id',
                'nidn' => 'INS-003',
                'nama' => 'Capt. Hendra Gunawan',
                'no_telepon' => '081234567003',
                'lisensi' => 'ATPL',
                'max_jam_terbang_harian' => 8.00,
                'total_jam_terbang' => 5100.00,
                'status' => 'aktif',
            ],
            [
                'email' => 'capt.dewi@api-banyuwangi.ac.id',
                'nidn' => 'INS-004',
                'nama' => 'Capt. Dewi Sartika',
                'no_telepon' => '081234567004',
                'lisensi' => 'CPL',
                'max_jam_terbang_harian' => 8.00,
                'total_jam_terbang' => 2800.25,
                'status' => 'aktif',
            ],
            [
                'email' => 'capt.agus@api-banyuwangi.ac.id',
                'nidn' => 'INS-005',
                'nama' => 'Capt. Agus Prayitno',
                'no_telepon' => '081234567005',
                'lisensi' => 'ATPL',
                'max_jam_terbang_harian' => 8.00,
                'total_jam_terbang' => 6700.00,
                'status' => 'cuti',
                'catatan' => 'Cuti medis sampai Oktober 2026',
            ],
        ];

        foreach ($instrukturData as $data) {
            $user = User::where('email', $data['email'])->first();

            if ($user) {
                Instruktur::create([
                    'user_id' => $user->id,
                    'nidn' => $data['nidn'],
                    'nama' => $data['nama'],
                    'no_telepon' => $data['no_telepon'],
                    'lisensi' => $data['lisensi'],
                    'max_jam_terbang_harian' => $data['max_jam_terbang_harian'],
                    'total_jam_terbang' => $data['total_jam_terbang'],
                    'status' => $data['status'],
                    'catatan' => $data['catatan'] ?? null,
                ]);
            }
        }
    }
}
