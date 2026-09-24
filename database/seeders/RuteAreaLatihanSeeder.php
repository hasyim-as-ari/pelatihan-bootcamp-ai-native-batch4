<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RuteAreaLatihan;

class RuteAreaLatihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rutes = [
            // Area Latihan Lokal
            [
                'kode_rute' => 'TRA-W1',
                'nama_rute' => 'Banyuwangi - Area Latihan Utara (Training Area North / W-1)',
                'kategori' => 'Area Latihan Lokal',
                'estimasi_durasi_jam' => 1.50,
                'deskripsi' => 'Area latihan manuver udara dasar dan lanjutan di sektor utara Banyuwangi (di atas Selat Bali utara dan pegunungan Ijen timur).',
                'is_active' => true,
            ],
            [
                'kode_rute' => 'TRA-W2',
                'nama_rute' => 'Banyuwangi - Area Latihan Selatan (Training Area South / W-2)',
                'kategori' => 'Area Latihan Lokal',
                'estimasi_durasi_jam' => 1.50,
                'deskripsi' => 'Area latihan manuver stall, steep turn, dan spin recovery di sektor pesisir selatan Grajagan.',
                'is_active' => true,
            ],
            [
                'kode_rute' => 'TRA-W3',
                'nama_rute' => 'Banyuwangi - Area Latihan Barat (Training Area West / W-3)',
                'kategori' => 'Area Latihan Lokal',
                'estimasi_durasi_jam' => 1.50,
                'deskripsi' => 'Area latihan navigasi darat dan visual checkpoint sektor barat Rogojampi - Genteng.',
                'is_active' => true,
            ],
            [
                'kode_rute' => 'TRA-W4',
                'nama_rute' => 'Banyuwangi - Area Latihan Timur (Training Area East / W-4)',
                'kategori' => 'Area Latihan Lokal',
                'estimasi_durasi_jam' => 1.50,
                'deskripsi' => 'Area latihan instrument flight dan overwater flying di atas perairan Selat Bali.',
                'is_active' => true,
            ],
            [
                'kode_rute' => 'LCL-CIRCUIT',
                'nama_rute' => 'Aerodrome Traffic Circuit (Local Pattern)',
                'kategori' => 'Sirkuit Lokal',
                'estimasi_durasi_jam' => 1.25,
                'deskripsi' => 'Pola lalu lintas landasan pacu Bandara Banyuwangi (Runway 08/26) untuk latihan takeoff, touch and go, dan landing.',
                'is_active' => true,
            ],

            // Navigasi Cross Country
            [
                'kode_rute' => 'XC-BWX-JBB',
                'nama_rute' => 'Banyuwangi - Jember (Notohadinegoro)',
                'kategori' => 'Navigasi Cross Country',
                'estimasi_durasi_jam' => 2.00,
                'deskripsi' => 'Rute latihan navigasi lintas bandara Banyuwangi (BWX) menuju Bandara Notohadinegoro Jember (JBB) PP.',
                'is_active' => true,
            ],
            [
                'kode_rute' => 'XC-BWX-SUB',
                'nama_rute' => 'Banyuwangi - Surabaya (Juanda)',
                'kategori' => 'Navigasi Cross Country',
                'estimasi_durasi_jam' => 3.00,
                'deskripsi' => 'Rute latihan navigasi lanjutan dan komunikasi ATC terminal area sibuk Bandara Internasional Juanda Surabaya (SUB) PP.',
                'is_active' => true,
            ],
            [
                'kode_rute' => 'XC-BWX-DPS',
                'nama_rute' => 'Banyuwangi - Bali (I Gusti Ngurah Rai)',
                'kategori' => 'Navigasi Cross Country',
                'estimasi_durasi_jam' => 2.50,
                'deskripsi' => 'Rute latihan navigasi menyeberang selat menuju Bandara Internasional I Gusti Ngurah Rai Denpasar (DPS) PP.',
                'is_active' => true,
            ],
            [
                'kode_rute' => 'XC-BWX-SUP',
                'nama_rute' => 'Banyuwangi - Sumenep (Trunojoyo)',
                'kategori' => 'Navigasi Cross Country',
                'estimasi_durasi_jam' => 2.50,
                'deskripsi' => 'Rute navigasi lintas pulau menuju Bandara Trunojoyo Sumenep Madura (SUP) PP.',
                'is_active' => true,
            ],
            [
                'kode_rute' => 'XC-BWX-MLG',
                'nama_rute' => 'Banyuwangi - Malang (Abdulrachman Saleh)',
                'kategori' => 'Navigasi Cross Country',
                'estimasi_durasi_jam' => 2.75,
                'deskripsi' => 'Rute navigasi pegunungan menuju Lanud/Bandara Abdulrachman Saleh Malang (MLG) PP.',
                'is_active' => true,
            ],
            [
                'kode_rute' => 'XC-BWX-SRG',
                'nama_rute' => 'Banyuwangi - Semarang (Jenderal Ahmad Yani)',
                'kategori' => 'Navigasi Cross Country',
                'estimasi_durasi_jam' => 4.00,
                'deskripsi' => 'Rute jarak jauh cross country long distance CPL menuju Bandara Internasional Jenderal Ahmad Yani Semarang (SRG) PP.',
                'is_active' => true,
            ],
        ];

        foreach ($rutes as $rute) {
            RuteAreaLatihan::updateOrCreate(
                ['kode_rute' => $rute['kode_rute']],
                $rute
            );
        }
    }
}
