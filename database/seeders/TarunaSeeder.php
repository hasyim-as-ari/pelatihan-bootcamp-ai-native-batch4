<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Taruna;
use App\Models\ModulPenerbangan;

class TarunaSeeder extends Seeder
{
    /**
     * Seed data taruna/taruni (mahasiswa penerbang).
     * Setiap taruna terhubung ke user account dengan role 'taruna'.
     */
    public function run(): void
    {
        $tarunaData = [
            [
                'email' => 'rizky.pratama@taruna.api-banyuwangi.ac.id',
                'nim' => 'TRN-2024-001',
                'nama' => 'Muhammad Rizky Pratama',
                'no_telepon' => '081234568001',
                'angkatan' => '2024',
                'batch' => 1,
                'status_batch' => 'A',
                'program_study' => 'D4 Penerbang Sayap Tetap',
                'modul_penerbangan' => 'PPL',
                'total_jam_terbang' => 45.50,
                'kuota_jam_terbang' => 200.00,
                'sisa_kuota_jam_terbang' => 154.50,
                'max_jam_terbang_harian' => 4.00,
            ],
            [
                'email' => 'ayu.lestari@taruna.api-banyuwangi.ac.id',
                'nim' => 'TRN-2024-002',
                'nama' => 'Ayu Lestari',
                'no_telepon' => '081234568002',
                'angkatan' => '2024',
                'batch' => 1,
                'status_batch' => 'A',
                'program_study' => 'D4 Penerbang Sayap Tetap',
                'modul_penerbangan' => 'PPL',
                'total_jam_terbang' => 38.25,
                'kuota_jam_terbang' => 200.00,
                'sisa_kuota_jam_terbang' => 161.75,
                'max_jam_terbang_harian' => 4.00,
            ],
            [
                'email' => 'dimas.saputra@taruna.api-banyuwangi.ac.id',
                'nim' => 'TRN-2024-003',
                'nama' => 'Dimas Saputra',
                'no_telepon' => '081234568003',
                'angkatan' => '2024',
                'batch' => 1,
                'status_batch' => 'B',
                'program_study' => 'D4 Penerbang Sayap Tetap',
                'modul_penerbangan' => 'CPL',
                'total_jam_terbang' => 120.75,
                'kuota_jam_terbang' => 250.00,
                'sisa_kuota_jam_terbang' => 129.25,
                'max_jam_terbang_harian' => 4.00,
            ],
            [
                'email' => 'putri.ramadhani@taruna.api-banyuwangi.ac.id',
                'nim' => 'TRN-2024-004',
                'nama' => 'Putri Ramadhani',
                'no_telepon' => '081234568004',
                'angkatan' => '2024',
                'batch' => 2,
                'status_batch' => 'A',
                'program_study' => 'D4 Penerbang Sayap Tetap',
                'modul_penerbangan' => 'PPL',
                'total_jam_terbang' => 25.00,
                'kuota_jam_terbang' => 200.00,
                'sisa_kuota_jam_terbang' => 175.00,
                'max_jam_terbang_harian' => 4.00,
            ],
            [
                'email' => 'bayu.firmansyah@taruna.api-banyuwangi.ac.id',
                'nim' => 'TRN-2023-001',
                'nama' => 'Bayu Firmansyah',
                'no_telepon' => '081234568005',
                'angkatan' => '2023',
                'batch' => 2,
                'status_batch' => 'B',
                'program_study' => 'D3 Penerbang Sayap Putar',
                'modul_penerbangan' => 'CPL',
                'total_jam_terbang' => 180.50,
                'kuota_jam_terbang' => 250.00,
                'sisa_kuota_jam_terbang' => 69.50,
                'max_jam_terbang_harian' => 4.00,
            ],
            [
                'email' => 'citra.dewi@taruna.api-banyuwangi.ac.id',
                'nim' => 'TRN-2023-002',
                'nama' => 'Citra Dewi',
                'no_telepon' => '081234568006',
                'angkatan' => '2023',
                'batch' => 3,
                'status_batch' => 'A',
                'program_study' => 'D3 Operasi Pesawat Udara',
                'modul_penerbangan' => 'IR',
                'total_jam_terbang' => 210.25,
                'kuota_jam_terbang' => 300.00,
                'sisa_kuota_jam_terbang' => 89.75,
                'max_jam_terbang_harian' => 4.00,
            ],
            [
                'email' => 'fajar.nugroho@taruna.api-banyuwangi.ac.id',
                'nim' => 'TRN-2023-003',
                'nama' => 'Fajar Nugroho',
                'no_telepon' => '081234568007',
                'angkatan' => '2023',
                'batch' => 3,
                'status_batch' => 'B',
                'program_study' => 'D4 Penerbang Sayap Tetap',
                'modul_penerbangan' => 'CPL',
                'total_jam_terbang' => 155.00,
                'kuota_jam_terbang' => 250.00,
                'sisa_kuota_jam_terbang' => 95.00,
                'max_jam_terbang_harian' => 4.00,
            ],
            [
                'email' => 'indah.permatasari@taruna.api-banyuwangi.ac.id',
                'nim' => 'TRN-2023-004',
                'nama' => 'Indah Permatasari',
                'no_telepon' => '081234568008',
                'angkatan' => '2023',
                'batch' => 3,
                'status_batch' => 'B',
                'program_study' => 'D4 Penerbang Sayap Tetap',
                'modul_penerbangan' => 'IR',
                'total_jam_terbang' => 195.75,
                'kuota_jam_terbang' => 300.00,
                'sisa_kuota_jam_terbang' => 104.25,
                'max_jam_terbang_harian' => 4.00,
            ],
            [
                'email' => 'kevin.anggara@taruna.api-banyuwangi.ac.id',
                'nim' => 'TRN-2024-005',
                'nama' => 'Kevin Anggara',
                'no_telepon' => '081234568009',
                'angkatan' => '2024',
                'batch' => 4,
                'status_batch' => 'A',
                'program_study' => 'D4 Penerbang Sayap Tetap',
                'modul_penerbangan' => 'PPL',
                'total_jam_terbang' => 15.00,
                'kuota_jam_terbang' => 200.00,
                'sisa_kuota_jam_terbang' => 185.00,
                'max_jam_terbang_harian' => 4.00,
            ],
            [
                'email' => 'nabila.azzahra@taruna.api-banyuwangi.ac.id',
                'nim' => 'TRN-2024-006',
                'nama' => 'Nabila Azzahra',
                'no_telepon' => '081234568010',
                'angkatan' => '2024',
                'batch' => 4,
                'status_batch' => 'B',
                'program_study' => 'D4 Penerbang Sayap Tetap',
                'modul_penerbangan' => 'PPL',
                'total_jam_terbang' => 30.00,
                'kuota_jam_terbang' => 200.00,
                'sisa_kuota_jam_terbang' => 170.00,
                'max_jam_terbang_harian' => 4.00,
            ],
        ];

        foreach ($tarunaData as $data) {
            $user = User::where('email', $data['email'])->first();

            if ($user) {
                $taruna = Taruna::updateOrCreate(
                    ['nim' => $data['nim']],
                    [
                        'user_id' => $user->id,
                        'nama' => $data['nama'],
                        'no_telepon' => $data['no_telepon'],
                        'angkatan' => $data['angkatan'],
                        'batch' => $data['batch'],
                        'status_batch' => $data['status_batch'],
                        'program_study' => $data['program_study'],
                        'modul_penerbangan' => $data['modul_penerbangan'],
                        'total_jam_terbang' => $data['total_jam_terbang'],
                        'kuota_jam_terbang' => $data['kuota_jam_terbang'],
                        'sisa_kuota_jam_terbang' => $data['sisa_kuota_jam_terbang'],
                        'max_jam_terbang_harian' => $data['max_jam_terbang_harian'],
                        'status' => 'aktif',
                    ]
                );

                // Hubungkan dengan modul-modul penerbangan sesuai lisensi target
                $modules = ModulPenerbangan::where('lisensi_target', $data['modul_penerbangan'])->pluck('id');
                if ($modules->isNotEmpty()) {
                    $taruna->modulPenerbangan()->syncWithoutDetaching($modules);
                    $taruna->syncModulPenerbanganString();
                }
            }
        }
    }
}
