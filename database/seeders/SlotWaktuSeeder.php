<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SlotWaktu;

class SlotWaktuSeeder extends Seeder
{
    /**
     * Seed data slot waktu penerbangan.
     * Dibagi menjadi slot pagi dan siang, masing-masing 1.5 jam.
     */
    public function run(): void
    {
        $slots = [
            [
                'nama_slot' => 'Pagi 1',
                'jam_mulai' => '06:00',
                'jam_selesai' => '07:30',
                'durasi_jam' => 1.50,
                'urutan' => 1,
            ],
            [
                'nama_slot' => 'Pagi 2',
                'jam_mulai' => '07:45',
                'jam_selesai' => '09:15',
                'durasi_jam' => 1.50,
                'urutan' => 2,
            ],
            [
                'nama_slot' => 'Pagi 3',
                'jam_mulai' => '09:30',
                'jam_selesai' => '11:00',
                'durasi_jam' => 1.50,
                'urutan' => 3,
            ],
            [
                'nama_slot' => 'Siang 1',
                'jam_mulai' => '13:00',
                'jam_selesai' => '14:30',
                'durasi_jam' => 1.50,
                'urutan' => 4,
            ],
            [
                'nama_slot' => 'Siang 2',
                'jam_mulai' => '14:45',
                'jam_selesai' => '16:15',
                'durasi_jam' => 1.50,
                'urutan' => 5,
            ],
            [
                'nama_slot' => 'Sore',
                'jam_mulai' => '16:30',
                'jam_selesai' => '17:30',
                'durasi_jam' => 1.00,
                'urutan' => 6,
            ],
        ];

        foreach ($slots as $slot) {
            SlotWaktu::create($slot);
        }
    }
}
