<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JadwalPenerbangan;
use App\Models\FlightLog;
use App\Models\User;

class FlightLogSeeder extends Seeder
{
    /**
     * Seed flight log untuk jadwal yang sudah completed.
     */
    public function run(): void
    {
        $completedJadwal = JadwalPenerbangan::where('status', 'completed')->get();
        $adminUser = User::where('role', 'admin_operasional')->first();

        $evaluasiOptions = ['lulus', 'lulus', 'lulus', 'perlu_pengulangan']; // 75% lulus
        $cuacaOptions = ['CAVOK (Clear)', 'Few Clouds', 'Scattered Clouds', 'Partly Cloudy'];

        foreach ($completedJadwal as $jadwal) {
            $jamTakeoff = $jadwal->jam_mulai;
            // Landing sedikit sebelum jam_selesai (simulasi real)
            $landingTime = date('H:i', strtotime($jadwal->jam_selesai) - rand(5, 15) * 60);

            $takeoffSeconds = strtotime($jamTakeoff);
            $landingSeconds = strtotime($landingTime);
            $durasi = round(($landingSeconds - $takeoffSeconds) / 3600, 2);

            FlightLog::create([
                'jadwal_penerbangan_id' => $jadwal->id,
                'taruna_id' => $jadwal->taruna_id,
                'instruktur_id' => $jadwal->instruktur_id,
                'pesawat_id' => $jadwal->pesawat_id,
                'tanggal' => $jadwal->tanggal,
                'jam_takeoff' => $jamTakeoff,
                'jam_landing' => $landingTime,
                'durasi_terbang' => $durasi > 0 ? $durasi : 1.25,
                'status' => 'completed',
                'catatan_evaluasi' => $this->generateCatatanEvaluasi(),
                'nilai' => rand(65, 95),
                'hasil_evaluasi' => $evaluasiOptions[array_rand($evaluasiOptions)],
                'kondisi_cuaca' => $cuacaOptions[array_rand($cuacaOptions)],
                'recorded_by' => $adminUser?->id,
            ]);
        }
    }

    /**
     * Generate catatan evaluasi sample
     */
    private function generateCatatanEvaluasi(): string
    {
        $catatan = [
            'Penerbangan berjalan lancar. Taruna menunjukkan progress yang baik dalam prosedur navigasi. Perlu latihan lebih untuk approach.',
            'Taruna mampu menyelesaikan traffic pattern dengan baik. Komunikasi radio perlu ditingkatkan.',
            'Manuver steep turn cukup bagus. Perlu perbaikan pada kecepatan approach saat landing.',
            'Cross country flight selesai sesuai rencana. Taruna perlu meningkatkan awareness terhadap weather condition.',
            'Emergency procedure dikuasai dengan baik. Recovery dari stall sudah sesuai standar.',
            'Solo flight berhasil dilaksanakan. Taruna menunjukkan kepercayaan diri yang baik.',
            'Instrument approach perlu pengulangan. Taruna belum stabil pada final approach course.',
            'Touch and go lancar, 5 kali pattern tanpa masalah. Landing sudah konsisten.',
        ];

        return $catatan[array_rand($catatan)];
    }
}
