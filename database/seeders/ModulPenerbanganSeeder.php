<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ModulPenerbangan;

class ModulPenerbanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            // PPL (Private Pilot License)
            [
                'kode_modul' => 'PPL-TP-01',
                'nama_modul' => 'Traffic Pattern',
                'lisensi_target' => 'PPL',
                'kategori' => 'Sirkuit & Takeoff-Landing',
                'standar_jam_terbang' => 1.50,
                'deskripsi' => 'Penguasaan pola sirkuit bandara (upwind, crosswind, downwind, base, final), radio telephony ATC, dan penyesuaian wind drift.',
                'is_active' => true,
            ],
            [
                'kode_modul' => 'PPL-TG-02',
                'nama_modul' => 'Touch and Go',
                'lisensi_target' => 'PPL',
                'kategori' => 'Sirkuit & Takeoff-Landing',
                'standar_jam_terbang' => 1.50,
                'deskripsi' => 'Pelatihan landing kontinu langsung takeoff kembali tanpa berhenti penuh untuk mematangkan flare dan kontrol kemudi.',
                'is_active' => true,
            ],
            [
                'kode_modul' => 'PPL-SOLO-03',
                'nama_modul' => 'Solo Flight',
                'lisensi_target' => 'PPL',
                'kategori' => 'Solo',
                'standar_jam_terbang' => 1.00,
                'deskripsi' => 'Penerbangan terbang solo mandiri pertama taruna tanpa pendampingan instruktur di dalam kokpit.',
                'is_active' => true,
            ],
            [
                'kode_modul' => 'PPL-ST-04',
                'nama_modul' => 'Steep Turn',
                'lisensi_target' => 'PPL',
                'kategori' => 'Manuver Dasar',
                'standar_jam_terbang' => 1.50,
                'deskripsi' => 'Manuver belokan tajam 45 derajat dengan menjaga ketinggian dan koordinasi aileron-rudder.',
                'is_active' => true,
            ],
            [
                'kode_modul' => 'PPL-SR-05',
                'nama_modul' => 'Stall Recovery',
                'lisensi_target' => 'PPL',
                'kategori' => 'Manuver Dasar',
                'standar_jam_terbang' => 1.50,
                'deskripsi' => 'Pengenalan kondisi stall (power-off / power-on) dan teknik pemulihan cepat (recovery) pada ketinggian aman.',
                'is_active' => true,
            ],
            [
                'kode_modul' => 'PPL-EMG-06',
                'nama_modul' => 'Emergency Procedure',
                'lisensi_target' => 'PPL',
                'kategori' => 'Prosedur Darurat',
                'standar_jam_terbang' => 1.50,
                'deskripsi' => 'Simulasi mati mesin mendadak di udara, forced landing ke field terbuka, cockpit fire, dan sistem checklist darurat.',
                'is_active' => true,
            ],
            [
                'kode_modul' => 'PPL-NAV-07',
                'nama_modul' => 'Navigation Flight',
                'lisensi_target' => 'PPL',
                'kategori' => 'Navigasi Visual',
                'standar_jam_terbang' => 2.50,
                'deskripsi' => 'Penerbangan navigasi VFR antar-titik koordinat dengan peta visual, dead reckoning, dan perhitungan konsumsi bahan bakar.',
                'is_active' => true,
            ],

            // CPL (Commercial Pilot License)
            [
                'kode_modul' => 'CPL-CM-01',
                'nama_modul' => 'Commercial Maneuvers',
                'lisensi_target' => 'CPL',
                'kategori' => 'Manuver Komersial',
                'standar_jam_terbang' => 2.00,
                'deskripsi' => 'Manuver tingkat lanjut meliputi Chandelles, Lazy Eights, Eights-on-Pylons, dan Steep Spirals dengan toleransi presisi tinggi.',
                'is_active' => true,
            ],
            [
                'kode_modul' => 'CPL-XC-02',
                'nama_modul' => 'Cross Country',
                'lisensi_target' => 'CPL',
                'kategori' => 'Navigasi Jarak Jauh',
                'standar_jam_terbang' => 3.50,
                'deskripsi' => 'Penerbangan jelajah jarak jauh lintas bandara minimum 300 NM dengan pendaratan di 2 bandara berbeda.',
                'is_active' => true,
            ],
            [
                'kode_modul' => 'CPL-NIT-03',
                'nama_modul' => 'Night Rating Preparation',
                'lisensi_target' => 'CPL',
                'kategori' => 'Penerbangan Malam',
                'standar_jam_terbang' => 2.00,
                'deskripsi' => 'Penerbangan malam hari mencakup visual night circuit, navigasi malam, dan ilusi visual pendaratan malam.',
                'is_active' => true,
            ],
            [
                'kode_modul' => 'CPL-ADV-04',
                'nama_modul' => 'Advanced Navigation Flight',
                'lisensi_target' => 'CPL',
                'kategori' => 'Navigasi Lanjutan',
                'standar_jam_terbang' => 3.00,
                'deskripsi' => 'Navigasi lanjutan dengan manajemen cuaca kompleks, variasi altitude, dan pengalihan rute alternatif (diversion).',
                'is_active' => true,
            ],

            // IR (Instrument Rating)
            [
                'kode_modul' => 'IR-BA-01',
                'nama_modul' => 'Basic Attitude Flying',
                'lisensi_target' => 'IR',
                'kategori' => 'Instrumen Dasar',
                'standar_jam_terbang' => 1.50,
                'deskripsi' => 'Terbang instrumen penuh di bawah hood/foggles tanpa referensi visual luar (six-pack instrument scan).',
                'is_active' => true,
            ],
            [
                'kode_modul' => 'IR-APP-02',
                'nama_modul' => 'Instrument Approach',
                'lisensi_target' => 'IR',
                'kategori' => 'Prosedur Pendekatan',
                'standar_jam_terbang' => 2.00,
                'deskripsi' => 'Prosedur pendekatan presisi (ILS) dan non-presisi (VOR/RNAV/RNP) hingga mencapai Decision Altitude/MDA.',
                'is_active' => true,
            ],
            [
                'kode_modul' => 'IR-HLD-03',
                'nama_modul' => 'IFR Procedure & Holding Pattern',
                'lisensi_target' => 'IR',
                'kategori' => 'Prosedur IFR',
                'standar_jam_terbang' => 2.00,
                'deskripsi' => 'Standar Departure (SID), Standard Arrival (STAR), dan eksekusi holding pattern standar/non-standar.',
                'is_active' => true,
            ],
            [
                'kode_modul' => 'IR-XC-04',
                'nama_modul' => 'Cross Country IFR',
                'lisensi_target' => 'IR',
                'kategori' => 'Navigasi IFR',
                'standar_jam_terbang' => 3.00,
                'deskripsi' => 'Penerbangan lintas bandara menggunakan rute airway IFR dan komunikasi kontrol lalu lintas udara (Air Traffic Control).',
                'is_active' => true,
            ],

            // MER (Multi Engine Rating)
            [
                'kode_modul' => 'MER-ASYM-01',
                'nama_modul' => 'Asymmetric Flight',
                'lisensi_target' => 'MER',
                'kategori' => 'Multi Engine',
                'standar_jam_terbang' => 2.00,
                'deskripsi' => 'Penguasaan terbang pesawat bermesin ganda pada kondisi satu mesin mati (critical engine failure, Vmc demo, zero sideslip).',
                'is_active' => true,
            ],
            [
                'kode_modul' => 'MER-XC-02',
                'nama_modul' => 'Multi Engine Cross Country',
                'lisensi_target' => 'MER',
                'kategori' => 'Multi Engine',
                'standar_jam_terbang' => 3.00,
                'deskripsi' => 'Navigasi jarak jauh menggunakan armada pesawat multi engine.',
                'is_active' => true,
            ],
        ];

        foreach ($modules as $module) {
            ModulPenerbangan::updateOrCreate(
                ['kode_modul' => $module['kode_modul']],
                $module
            );
        }
    }
}
