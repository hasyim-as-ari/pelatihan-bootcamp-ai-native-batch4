<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pesawat;

class PesawatSeeder extends Seeder
{
    /**
     * Seed data armada pesawat latih.
     */
    public function run(): void
    {
        $pesawatData = [
            [
                'nomor_registrasi' => 'PK-API01',
                'tipe_pesawat' => 'Cessna 172S Skyhawk',
                'nama_pesawat' => 'Garuda Alpha',
                'total_jam_terbang' => 2450.50,
                'jam_terbang_sebelum_maintenance' => 49.50,
                'status' => 'available',
                'tanggal_maintenance_terakhir' => '2026-08-15',
                'tanggal_maintenance_berikutnya' => '2026-10-15',
                'kapasitas_penumpang' => 2,
            ],
            [
                'nomor_registrasi' => 'PK-API02',
                'tipe_pesawat' => 'Cessna 172S Skyhawk',
                'nama_pesawat' => 'Garuda Bravo',
                'total_jam_terbang' => 1800.75,
                'jam_terbang_sebelum_maintenance' => 99.25,
                'status' => 'available',
                'tanggal_maintenance_terakhir' => '2026-07-20',
                'tanggal_maintenance_berikutnya' => '2026-11-20',
                'kapasitas_penumpang' => 2,
            ],
            [
                'nomor_registrasi' => 'PK-API03',
                'tipe_pesawat' => 'Piper PA-28 Cherokee',
                'nama_pesawat' => 'Garuda Charlie',
                'total_jam_terbang' => 3100.00,
                'jam_terbang_sebelum_maintenance' => 75.00,
                'status' => 'available',
                'tanggal_maintenance_terakhir' => '2026-09-01',
                'tanggal_maintenance_berikutnya' => '2026-12-01',
                'kapasitas_penumpang' => 2,
            ],
            [
                'nomor_registrasi' => 'PK-API04',
                'tipe_pesawat' => 'Piper PA-28 Cherokee',
                'nama_pesawat' => 'Garuda Delta',
                'total_jam_terbang' => 2200.25,
                'jam_terbang_sebelum_maintenance' => 5.75,
                'status' => 'maintenance',
                'tanggal_maintenance_terakhir' => '2026-09-20',
                'tanggal_maintenance_berikutnya' => '2026-10-10',
                'kapasitas_penumpang' => 2,
                'catatan' => 'Sedang dalam inspeksi 100 jam',
            ],
            [
                'nomor_registrasi' => 'PK-API05',
                'tipe_pesawat' => 'Diamond DA40 Star',
                'nama_pesawat' => 'Garuda Echo',
                'total_jam_terbang' => 950.00,
                'jam_terbang_sebelum_maintenance' => 150.00,
                'status' => 'available',
                'tanggal_maintenance_terakhir' => '2026-08-01',
                'tanggal_maintenance_berikutnya' => '2027-02-01',
                'kapasitas_penumpang' => 2,
            ],
            [
                'nomor_registrasi' => 'PK-API06',
                'tipe_pesawat' => 'Diamond DA42 Twin Star',
                'nama_pesawat' => 'Garuda Foxtrot',
                'total_jam_terbang' => 1500.50,
                'jam_terbang_sebelum_maintenance' => 100.00,
                'status' => 'available',
                'tanggal_maintenance_terakhir' => '2026-07-15',
                'tanggal_maintenance_berikutnya' => '2026-12-15',
                'kapasitas_penumpang' => 2,
                'catatan' => 'Pesawat twin-engine untuk modul IR/ME',
            ],
            [
                'nomor_registrasi' => 'PK-API07',
                'tipe_pesawat' => 'Cessna 152',
                'nama_pesawat' => 'Garuda Golf',
                'total_jam_terbang' => 4100.00,
                'jam_terbang_sebelum_maintenance' => 0,
                'status' => 'grounded',
                'tanggal_maintenance_terakhir' => '2026-06-01',
                'tanggal_maintenance_berikutnya' => null,
                'kapasitas_penumpang' => 2,
                'catatan' => 'Grounded - menunggu suku cadang engine overhaul',
            ],
        ];

        foreach ($pesawatData as $data) {
            Pesawat::create($data);
        }
    }
}
