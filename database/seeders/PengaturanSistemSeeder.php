<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PengaturanSistem;

class PengaturanSistemSeeder extends Seeder
{
    /**
     * Seed pengaturan sistem default.
     * Konfigurasi global: batas jam terbang, rest period,
     * batas waktu pengajuan reschedule, dan parameter operasional.
     */
    public function run(): void
    {
        $pengaturan = [
            // Grup: jam_terbang
            [
                'kunci' => 'max_jam_terbang_harian_instruktur',
                'nilai' => '8',
                'tipe_data' => 'decimal',
                'grup' => 'jam_terbang',
                'deskripsi' => 'Maksimal jam terbang harian instruktur (jam) sesuai regulasi DGCA/DKPPU',
            ],
            [
                'kunci' => 'max_jam_terbang_harian_taruna',
                'nilai' => '4',
                'tipe_data' => 'decimal',
                'grup' => 'jam_terbang',
                'deskripsi' => 'Maksimal jam terbang harian taruna (jam) sesuai regulasi',
            ],
            [
                'kunci' => 'peringatan_jam_terbang_persen',
                'nilai' => '80',
                'tipe_data' => 'integer',
                'grup' => 'jam_terbang',
                'deskripsi' => 'Persentase jam terbang harian yang memicu peringatan (contoh: 80%)',
            ],

            // Grup: rest_period
            [
                'kunci' => 'rest_period_instruktur_menit',
                'nilai' => '60',
                'tipe_data' => 'integer',
                'grup' => 'rest_period',
                'deskripsi' => 'Jeda waktu istirahat minimal instruktur antar penerbangan (menit)',
            ],
            [
                'kunci' => 'rest_period_taruna_menit',
                'nilai' => '90',
                'tipe_data' => 'integer',
                'grup' => 'rest_period',
                'deskripsi' => 'Jeda waktu istirahat minimal taruna antar penerbangan (menit)',
            ],

            // Grup: reschedule
            [
                'kunci' => 'batas_waktu_reschedule_jam',
                'nilai' => '24',
                'tipe_data' => 'integer',
                'grup' => 'reschedule',
                'deskripsi' => 'Batas waktu pengajuan reschedule sebelum jadwal penerbangan semula (jam)',
            ],
            [
                'kunci' => 'max_reschedule_per_taruna_per_bulan',
                'nilai' => '3',
                'tipe_data' => 'integer',
                'grup' => 'reschedule',
                'deskripsi' => 'Maksimal pengajuan reschedule per taruna per bulan',
            ],

            // Grup: maintenance
            [
                'kunci' => 'peringatan_maintenance_jam',
                'nilai' => '10',
                'tipe_data' => 'decimal',
                'grup' => 'maintenance',
                'deskripsi' => 'Peringatan maintenance pesawat ketika sisa jam terbang sebelum maintenance ≤ nilai ini',
            ],

            // Grup: umum
            [
                'kunci' => 'nama_akademi',
                'nilai' => 'Akademi Penerbang Indonesia Banyuwangi',
                'tipe_data' => 'string',
                'grup' => 'umum',
                'deskripsi' => 'Nama akademi/instansi',
            ],
            [
                'kunci' => 'zona_waktu',
                'nilai' => 'Asia/Jakarta',
                'tipe_data' => 'string',
                'grup' => 'umum',
                'deskripsi' => 'Zona waktu operasional (WIB)',
            ],
        ];

        foreach ($pengaturan as $data) {
            PengaturanSistem::create($data);
        }
    }
}
