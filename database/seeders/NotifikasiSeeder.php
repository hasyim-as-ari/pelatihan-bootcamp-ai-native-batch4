<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notifikasi;
use App\Models\User;

class NotifikasiSeeder extends Seeder
{
    /**
     * Seed notifikasi sample untuk berbagai tipe pengguna.
     */
    public function run(): void
    {
        // Notifikasi untuk semua taruna - jadwal baru
        $tarunaUsers = User::where('role', 'taruna')->get();
        foreach ($tarunaUsers->take(5) as $user) {
            Notifikasi::create([
                'user_id' => $user->id,
                'judul' => 'Jadwal Penerbangan Baru',
                'pesan' => 'Jadwal penerbangan Anda untuk hari ini telah dipublikasikan. Silakan periksa detail jadwal Anda.',
                'tipe' => 'jadwal_baru',
                'dibaca' => false,
            ]);
        }

        // Notifikasi untuk instruktur - jadwal berubah
        $instrukturUsers = User::where('role', 'instruktur')->get();
        foreach ($instrukturUsers->take(3) as $user) {
            Notifikasi::create([
                'user_id' => $user->id,
                'judul' => 'Jadwal Penerbangan Diperbarui',
                'pesan' => 'Terdapat perubahan pada jadwal penerbangan Anda hari ini. Mohon periksa jadwal terbaru.',
                'tipe' => 'jadwal_berubah',
                'dibaca' => false,
            ]);
        }

        // Notifikasi untuk admin - reschedule diajukan
        $adminUsers = User::where('role', 'admin_operasional')->get();
        foreach ($adminUsers as $user) {
            Notifikasi::create([
                'user_id' => $user->id,
                'judul' => 'Pengajuan Reschedule Baru',
                'pesan' => 'Terdapat pengajuan reschedule penerbangan yang memerlukan persetujuan Anda. Segera tinjau pengajuan tersebut.',
                'tipe' => 'reschedule_diajukan',
                'dibaca' => false,
            ]);
        }

        // Notifikasi peringatan maintenance untuk admin
        foreach ($adminUsers as $user) {
            Notifikasi::create([
                'user_id' => $user->id,
                'judul' => 'Peringatan Maintenance Pesawat',
                'pesan' => 'Pesawat PK-API01 (Garuda Alpha) mendekati batas jam terbang untuk maintenance berikutnya. Sisa: 49.5 jam.',
                'tipe' => 'peringatan_maintenance',
                'dibaca' => true,
                'dibaca_pada' => now()->subHours(3),
            ]);
        }

        // Notifikasi reschedule disetujui untuk taruna
        $firstTaruna = $tarunaUsers->first();
        if ($firstTaruna) {
            Notifikasi::create([
                'user_id' => $firstTaruna->id,
                'judul' => 'Reschedule Disetujui',
                'pesan' => 'Pengajuan reschedule penerbangan Anda telah disetujui. Jadwal baru telah diperbarui.',
                'tipe' => 'reschedule_disetujui',
                'dibaca' => true,
                'dibaca_pada' => now()->subHour(),
            ]);
        }

        // Notifikasi peringatan jam terbang
        $instrukturUser = $instrukturUsers->first();
        if ($instrukturUser) {
            Notifikasi::create([
                'user_id' => $instrukturUser->id,
                'judul' => 'Peringatan Batas Jam Terbang',
                'pesan' => 'Anda telah mencapai 80% dari batas jam terbang harian. Sisa kuota: 1.6 jam hari ini.',
                'tipe' => 'peringatan_jam_terbang',
                'dibaca' => false,
            ]);
        }
    }
}
