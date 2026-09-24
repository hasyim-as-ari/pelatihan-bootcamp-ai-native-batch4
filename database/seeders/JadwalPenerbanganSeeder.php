<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instruktur;
use App\Models\Taruna;
use App\Models\Pesawat;
use App\Models\JadwalPenerbangan;
use App\Models\User;

class JadwalPenerbanganSeeder extends Seeder
{
    /**
     * Seed jadwal penerbangan sample.
     * Membuat jadwal untuk beberapa hari ke depan dengan berbagai status.
     */
    public function run(): void
    {
        $adminUser = User::where('role', 'admin_operasional')->first();
        $instrukturList = Instruktur::where('status', 'aktif')->get();
        $tarunaList = Taruna::where('status', 'aktif')->get();
        $pesawatList = Pesawat::where('status', 'available')->get();

        if ($instrukturList->isEmpty() || $tarunaList->isEmpty() || $pesawatList->isEmpty()) {
            return;
        }

        $today = now()->toDateString();
        $tomorrow = now()->addDay()->toDateString();
        $dayAfter = now()->addDays(2)->toDateString();
        $yesterday = now()->subDay()->toDateString();

        // Jadwal hari kemarin (completed)
        $jadwalKemarin = [
            [
                'tanggal' => $yesterday,
                'jam_mulai' => '06:00',
                'jam_selesai' => '07:30',
                'taruna_index' => 0,
                'instruktur_index' => 0,
                'pesawat_index' => 0,
                'rute' => 'Banyuwangi - Area Latihan Utara',
                'modul' => 'Navigation Flight',
                'status' => 'completed',
            ],
            [
                'tanggal' => $yesterday,
                'jam_mulai' => '07:45',
                'jam_selesai' => '09:15',
                'taruna_index' => 1,
                'instruktur_index' => 1,
                'pesawat_index' => 1,
                'rute' => 'Banyuwangi - Area Latihan Selatan',
                'modul' => 'Traffic Pattern',
                'status' => 'completed',
            ],
            [
                'tanggal' => $yesterday,
                'jam_mulai' => '06:00',
                'jam_selesai' => '07:30',
                'taruna_index' => 2,
                'instruktur_index' => 2,
                'pesawat_index' => 2,
                'rute' => 'Banyuwangi - Area Latihan Barat',
                'modul' => 'Cross Country',
                'status' => 'completed',
            ],
        ];

        // Jadwal hari ini (berbagai status)
        $jadwalHariIni = [
            [
                'tanggal' => $today,
                'jam_mulai' => '06:00',
                'jam_selesai' => '07:30',
                'taruna_index' => 0,
                'instruktur_index' => 0,
                'pesawat_index' => 0,
                'rute' => 'Banyuwangi - Area Latihan Utara',
                'modul' => 'Solo Flight',
                'status' => 'completed',
            ],
            [
                'tanggal' => $today,
                'jam_mulai' => '07:45',
                'jam_selesai' => '09:15',
                'taruna_index' => 3,
                'instruktur_index' => 1,
                'pesawat_index' => 1,
                'rute' => 'Banyuwangi - Area Latihan Timur',
                'modul' => 'Instrument Approach',
                'status' => 'in_flight',
            ],
            [
                'tanggal' => $today,
                'jam_mulai' => '09:30',
                'jam_selesai' => '11:00',
                'taruna_index' => 4,
                'instruktur_index' => 2,
                'pesawat_index' => 2,
                'rute' => 'Banyuwangi - Area Latihan Selatan',
                'modul' => 'Emergency Procedure',
                'status' => 'scheduled',
            ],
            [
                'tanggal' => $today,
                'jam_mulai' => '13:00',
                'jam_selesai' => '14:30',
                'taruna_index' => 5,
                'instruktur_index' => 0,
                'pesawat_index' => 4,
                'rute' => 'Banyuwangi - Area Latihan Barat',
                'modul' => 'Night Rating Preparation',
                'status' => 'scheduled',
            ],
            [
                'tanggal' => $today,
                'jam_mulai' => '14:45',
                'jam_selesai' => '16:15',
                'taruna_index' => 6,
                'instruktur_index' => 3,
                'pesawat_index' => 0,
                'rute' => 'Banyuwangi - Area Latihan Utara',
                'modul' => 'Stall Recovery',
                'status' => 'scheduled',
            ],
            [
                'tanggal' => $today,
                'jam_mulai' => '06:00',
                'jam_selesai' => '07:30',
                'taruna_index' => 7,
                'instruktur_index' => 3,
                'pesawat_index' => 4,
                'rute' => 'Banyuwangi - Area Latihan Selatan',
                'modul' => 'Cross Country',
                'status' => 'cancelled',
            ],
        ];

        // Jadwal besok (scheduled)
        $jadwalBesok = [
            [
                'tanggal' => $tomorrow,
                'jam_mulai' => '06:00',
                'jam_selesai' => '07:30',
                'taruna_index' => 1,
                'instruktur_index' => 0,
                'pesawat_index' => 0,
                'rute' => 'Banyuwangi - Area Latihan Utara',
                'modul' => 'Steep Turn',
                'status' => 'scheduled',
            ],
            [
                'tanggal' => $tomorrow,
                'jam_mulai' => '07:45',
                'jam_selesai' => '09:15',
                'taruna_index' => 2,
                'instruktur_index' => 1,
                'pesawat_index' => 1,
                'rute' => 'Banyuwangi - Area Latihan Timur',
                'modul' => 'Navigation Flight',
                'status' => 'scheduled',
            ],
            [
                'tanggal' => $tomorrow,
                'jam_mulai' => '09:30',
                'jam_selesai' => '11:00',
                'taruna_index' => 8,
                'instruktur_index' => 2,
                'pesawat_index' => 2,
                'rute' => 'Banyuwangi - Area Latihan Selatan',
                'modul' => 'Touch and Go',
                'status' => 'scheduled',
            ],
            [
                'tanggal' => $tomorrow,
                'jam_mulai' => '13:00',
                'jam_selesai' => '14:30',
                'taruna_index' => 9,
                'instruktur_index' => 3,
                'pesawat_index' => 4,
                'rute' => 'Banyuwangi - Area Latihan Barat',
                'modul' => 'Traffic Pattern',
                'status' => 'scheduled',
            ],
        ];

        // Jadwal lusa (draft)
        $jadwalLusa = [
            [
                'tanggal' => $dayAfter,
                'jam_mulai' => '06:00',
                'jam_selesai' => '07:30',
                'taruna_index' => 5,
                'instruktur_index' => 1,
                'pesawat_index' => 0,
                'rute' => 'Banyuwangi - Area Latihan Utara',
                'modul' => 'IFR Procedure',
                'status' => 'draft',
            ],
            [
                'tanggal' => $dayAfter,
                'jam_mulai' => '07:45',
                'jam_selesai' => '09:15',
                'taruna_index' => 6,
                'instruktur_index' => 2,
                'pesawat_index' => 1,
                'rute' => 'Banyuwangi - Area Latihan Timur',
                'modul' => 'Cross Country',
                'status' => 'draft',
            ],
        ];

        $allJadwal = array_merge($jadwalKemarin, $jadwalHariIni, $jadwalBesok, $jadwalLusa);

        foreach ($allJadwal as $data) {
            $taruna = $tarunaList[$data['taruna_index']] ?? $tarunaList->first();
            $instruktur = $instrukturList[$data['instruktur_index']] ?? $instrukturList->first();
            $pesawat = $pesawatList[$data['pesawat_index']] ?? $pesawatList->first();

            JadwalPenerbangan::create([
                'kode_jadwal' => JadwalPenerbangan::generateKodeJadwal($data['tanggal']),
                'tanggal' => $data['tanggal'],
                'jam_mulai' => $data['jam_mulai'],
                'jam_selesai' => $data['jam_selesai'],
                'taruna_id' => $taruna->id,
                'instruktur_id' => $instruktur->id,
                'pesawat_id' => $pesawat->id,
                'rute_area_latihan' => $data['rute'],
                'modul_penerbangan' => $data['modul'],
                'status' => $data['status'],
                'created_by' => $adminUser?->id,
                'published_at' => in_array($data['status'], ['scheduled', 'in_flight', 'completed', 'cancelled']) ? now() : null,
            ]);
        }
    }
}
