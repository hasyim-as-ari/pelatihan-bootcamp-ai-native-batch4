<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ActivityLogSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'super_admin')->first();
        $ops = User::where('role', 'admin_operasional')->first();
        $instruktur = User::where('role', 'instruktur')->first();
        $taruna = User::where('role', 'taruna')->first();

        $adminId = $admin?->id ?? 1;
        $opsId = $ops?->id ?? 2;
        $instrukturId = $instruktur?->id ?? 4;
        $tarunaId = $taruna?->id ?? 7;

        $now = Carbon::now();

        $logs = [
            [
                'user_id' => $adminId,
                'action_type' => 'LOGIN',
                'module_name' => 'Authentication',
                'record_id' => null,
                'old_values' => null,
                'new_values' => null,
                'ip_address' => '192.168.1.10',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',
                'description' => 'Pengguna ' . ($admin?->name ?? 'Admin Super') . ' berhasil masuk ke sistem',
                'created_at' => $now->copy()->subMinutes(12),
            ],
            [
                'user_id' => $opsId,
                'action_type' => 'LOGIN',
                'module_name' => 'Authentication',
                'record_id' => null,
                'old_values' => null,
                'new_values' => null,
                'ip_address' => '192.168.1.15',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'description' => 'Pengguna ' . ($ops?->name ?? 'Ahmad Fauzi') . ' berhasil masuk ke sistem',
                'created_at' => $now->copy()->subHours(1)->subMinutes(5),
            ],
            [
                'user_id' => $opsId,
                'action_type' => 'INSERT',
                'module_name' => 'Jadwal Penerbangan',
                'record_id' => 12,
                'old_values' => null,
                'new_values' => [
                    'kode_jadwal' => 'FL-2024-0012',
                    'tanggal' => $now->toDateString(),
                    'pesawat' => 'PK-API-01',
                    'instruktur' => 'Capt. Budi Santoso',
                ],
                'ip_address' => '192.168.1.15',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'description' => 'Menambahkan jadwal penerbangan baru [FL-2024-0012]',
                'created_at' => $now->copy()->subHours(1)->subMinutes(25),
            ],
            [
                'user_id' => $instrukturId,
                'action_type' => 'LOGIN',
                'module_name' => 'Authentication',
                'record_id' => null,
                'old_values' => null,
                'new_values' => null,
                'ip_address' => '192.168.1.22',
                'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7)',
                'description' => 'Pengguna ' . ($instruktur?->name ?? 'Capt. Budi Santoso') . ' berhasil masuk ke sistem',
                'created_at' => $now->copy()->subHours(2)->subMinutes(10),
            ],
            [
                'user_id' => $adminId,
                'action_type' => 'UPDATE',
                'module_name' => 'Armada Pesawat',
                'record_id' => 2,
                'old_values' => ['status' => 'maintenance'],
                'new_values' => ['status' => 'available'],
                'ip_address' => '192.168.1.10',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/124.0',
                'description' => 'Memperbarui status kelaikan pesawat PK-API-02 menjadi Tersedia',
                'created_at' => $now->copy()->subHours(3)->subMinutes(40),
            ],
            [
                'user_id' => $tarunaId,
                'action_type' => 'LOGIN',
                'module_name' => 'Authentication',
                'record_id' => null,
                'old_values' => null,
                'new_values' => null,
                'ip_address' => '192.168.1.45',
                'user_agent' => 'Mozilla/5.0 (Android 14; Mobile; rv:124.0)',
                'description' => 'Pengguna ' . ($taruna?->name ?? 'Taruna') . ' berhasil masuk ke sistem',
                'created_at' => $now->copy()->subHours(4)->subMinutes(15),
            ],
            [
                'user_id' => $tarunaId,
                'action_type' => 'LOGOUT',
                'module_name' => 'Authentication',
                'record_id' => null,
                'old_values' => null,
                'new_values' => null,
                'ip_address' => '192.168.1.45',
                'user_agent' => 'Mozilla/5.0 (Android 14; Mobile; rv:124.0)',
                'description' => 'Pengguna ' . ($taruna?->name ?? 'Taruna') . ' keluar dari sistem',
                'created_at' => $now->copy()->subHours(4)->subMinutes(2),
            ],
            [
                'user_id' => 123,
                'action_type' => 'INSERT',
                'module_name' => 'Produk',
                'record_id' => 45,
                'old_values' => null,
                'new_values' => ['nama' => 'Laptop Asus', 'harga' => 7500000, 'stok' => 10],
                'ip_address' => '192.168.1.10',
                'user_agent' => 'Mozilla/5.0...',
                'description' => 'Menambahkan produk baru: Laptop Asus',
                'created_at' => $now->copy()->subHours(5)->subMinutes(12),
            ],
            [
                'user_id' => 123,
                'action_type' => 'UPDATE',
                'module_name' => 'Produk',
                'record_id' => 45,
                'old_values' => ['harga' => 7500000, 'stok' => 10],
                'new_values' => ['harga' => 7000000, 'stok' => 8],
                'ip_address' => '192.168.1.10',
                'user_agent' => 'Mozilla/5.0...',
                'description' => 'Mengubah harga dan stok produk ID 45',
                'created_at' => $now->copy()->subHours(5)->subMinutes(10),
            ],
        ];

        foreach ($logs as $log) {
            ActivityLog::create($log);
        }
    }
}
