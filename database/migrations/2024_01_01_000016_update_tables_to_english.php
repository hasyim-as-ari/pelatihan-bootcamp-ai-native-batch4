<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Update Instruktur status enum
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE instruktur MODIFY COLUMN status ENUM('active', 'leave', 'inactive', 'aktif', 'cuti', 'nonaktif') DEFAULT 'active'");
        }
        DB::table('instruktur')->where('status', 'aktif')->update(['status' => 'active']);
        DB::table('instruktur')->where('status', 'cuti')->update(['status' => 'leave']);
        DB::table('instruktur')->where('status', 'nonaktif')->update(['status' => 'inactive']);

        // 2. Update Taruna status enum & program study
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE taruna MODIFY COLUMN status ENUM('active', 'leave', 'graduated', 'inactive', 'aktif', 'cuti', 'lulus', 'nonaktif') DEFAULT 'active'");
        }
        DB::table('taruna')->where('status', 'aktif')->update(['status' => 'active']);
        DB::table('taruna')->where('status', 'cuti')->update(['status' => 'leave']);
        DB::table('taruna')->where('status', 'lulus')->update(['status' => 'graduated']);
        DB::table('taruna')->where('status', 'nonaktif')->update(['status' => 'inactive']);

        DB::table('taruna')->where('program_study', 'D4 Penerbang Sayap Tetap')->update(['program_study' => 'D4 Fixed-Wing Commercial Pilot']);
        DB::table('taruna')->where('program_study', 'D3 Penerbang Sayap Putar')->update(['program_study' => 'D3 Rotary-Wing Helicopter Pilot']);
        DB::table('taruna')->where('program_study', 'D3 Operasi Pesawat Udara')->update(['program_study' => 'D3 Flight Operations']);

        // 3. Update Users
        DB::table('users')->where('name', 'Admin Super')->update(['name' => 'Super Admin']);

        // 4. Update System Settings Descriptions
        $settingsTranslations = [
            'max_jam_terbang_harian_instruktur' => 'Maximum daily flight hours for instructors (hours) according to DGCA regulations',
            'max_jam_terbang_harian_taruna' => 'Maximum daily flight hours for cadets/students (hours)',
            'peringatan_jam_terbang_persen' => 'Flight hour warning threshold percentage (e.g. 80%)',
            'rest_period_instruktur_menit' => 'Minimum mandatory rest period for instructors between flights (minutes)',
            'rest_period_taruna_menit' => 'Minimum mandatory rest period for cadets between flights (minutes)',
            'batas_waktu_reschedule_jam' => 'Reschedule request lead time before scheduled flight (hours)',
            'max_reschedule_per_taruna_per_bulan' => 'Maximum reschedule requests permitted per cadet per month',
            'peringatan_maintenance_jam' => 'Aircraft maintenance warning threshold when remaining airframe hours <= value',
            'nama_akademi' => 'Aviation Academy / Institute Name',
            'zona_waktu' => 'Operational timezone (WIB)',
        ];
        foreach ($settingsTranslations as $key => $desc) {
            DB::table('pengaturan_sistem')->where('kunci', $key)->update(['deskripsi' => $desc]);
        }

        // 5. Update Activity logs
        if (Schema::hasTable('activity_logs')) {
            DB::table('activity_logs')->where('module_name', 'Manajemen Produk')->update(['module_name' => 'Product Management']);
            DB::table('activity_logs')->where('module_name', 'Data Karyawan')->update(['module_name' => 'Employee Records']);
            DB::table('activity_logs')->where('module_name', 'Armada Pesawat')->update(['module_name' => 'Aircraft Fleet']);
            DB::table('activity_logs')->where('module_name', 'Jadwal Penerbangan')->update(['module_name' => 'Flight Schedule']);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
