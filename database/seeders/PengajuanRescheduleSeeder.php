<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JadwalPenerbangan;
use App\Models\PengajuanReschedule;
use App\Models\User;

class PengajuanRescheduleSeeder extends Seeder
{
    /**
     * Seed data pengajuan reschedule sample.
     */
    public function run(): void
    {
        // Ambil jadwal yang dibatalkan
        $cancelledJadwal = JadwalPenerbangan::where('status', 'cancelled')->first();
        $adminUser = User::where('role', 'admin_operasional')->first();

        if ($cancelledJadwal) {
            $taruna = $cancelledJadwal->taruna;
            $tarunaUser = $taruna ? $taruna->user : null;

            if ($tarunaUser) {
                // Pengajuan yang sudah disetujui
                PengajuanReschedule::create([
                    'kode_pengajuan' => PengajuanReschedule::generateKodePengajuan(now()->toDateString()),
                    'jadwal_penerbangan_id' => $cancelledJadwal->id,
                    'pemohon_id' => $tarunaUser->id,
                    'tipe_pemohon' => 'taruna',
                    'tanggal_awal' => $cancelledJadwal->tanggal,
                    'jam_mulai_awal' => $cancelledJadwal->jam_mulai,
                    'jam_selesai_awal' => $cancelledJadwal->jam_selesai,
                    'tanggal_pengganti' => now()->addDays(3)->toDateString(),
                    'jam_mulai_pengganti' => '09:30',
                    'jam_selesai_pengganti' => '11:00',
                    'alasan_kategori' => 'medis',
                    'alasan_detail' => 'Taruna mengalami flu dan demam tinggi, tidak fit untuk terbang. Surat keterangan dokter terlampir.',
                    'status' => 'approved',
                    'catatan_admin' => 'Disetujui. Jadwal dipindahkan ke slot Pagi 3 hari Jumat.',
                    'diproses_oleh' => $adminUser?->id,
                    'diproses_pada' => now()->subHours(2),
                ]);
            }
        }

        // Ambil jadwal scheduled untuk pengajuan pending
        $scheduledJadwal = JadwalPenerbangan::where('status', 'scheduled')->skip(1)->first();

        if ($scheduledJadwal) {
            $instruktur = $scheduledJadwal->instruktur;
            $instrukturUser = $instruktur ? $instruktur->user : null;

            if ($instrukturUser) {
                // Pengajuan yang masih pending
                PengajuanReschedule::create([
                    'kode_pengajuan' => PengajuanReschedule::generateKodePengajuan(now()->toDateString()),
                    'jadwal_penerbangan_id' => $scheduledJadwal->id,
                    'pemohon_id' => $instrukturUser->id,
                    'tipe_pemohon' => 'instruktur',
                    'tanggal_awal' => $scheduledJadwal->tanggal,
                    'jam_mulai_awal' => $scheduledJadwal->jam_mulai,
                    'jam_selesai_awal' => $scheduledJadwal->jam_selesai,
                    'tanggal_pengganti' => now()->addDays(4)->toDateString(),
                    'jam_mulai_pengganti' => '13:00',
                    'jam_selesai_pengganti' => '14:30',
                    'alasan_kategori' => 'cuaca_buruk',
                    'alasan_detail' => 'Prakiraan cuaca menunjukkan potensi thunderstorm pada slot waktu penerbangan. Visibilitas diperkirakan di bawah minimum untuk VFR.',
                    'status' => 'pending',
                ]);
            }
        }

        // Pengajuan yang ditolak
        $anotherScheduled = JadwalPenerbangan::where('status', 'scheduled')->skip(2)->first();

        if ($anotherScheduled) {
            $taruna = $anotherScheduled->taruna;
            $tarunaUser = $taruna ? $taruna->user : null;

            if ($tarunaUser) {
                PengajuanReschedule::create([
                    'kode_pengajuan' => PengajuanReschedule::generateKodePengajuan(now()->toDateString()),
                    'jadwal_penerbangan_id' => $anotherScheduled->id,
                    'pemohon_id' => $tarunaUser->id,
                    'tipe_pemohon' => 'taruna',
                    'tanggal_awal' => $anotherScheduled->tanggal,
                    'jam_mulai_awal' => $anotherScheduled->jam_mulai,
                    'jam_selesai_awal' => $anotherScheduled->jam_selesai,
                    'tanggal_pengganti' => now()->addDays(5)->toDateString(),
                    'jam_mulai_pengganti' => '06:00',
                    'jam_selesai_pengganti' => '07:30',
                    'alasan_kategori' => 'keperluan_mendesak',
                    'alasan_detail' => 'Ada acara keluarga yang tidak bisa ditinggalkan.',
                    'status' => 'rejected',
                    'catatan_admin' => 'Ditolak. Alasan tidak memenuhi kriteria reschedule darurat. Silakan ajukan cuti terlebih dahulu melalui bagian kemahasiswaan.',
                    'diproses_oleh' => $adminUser?->id,
                    'diproses_pada' => now()->subHours(5),
                ]);
            }
        }
    }
}
