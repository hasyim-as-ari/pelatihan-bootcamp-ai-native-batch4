<?php

namespace Tests\Feature;

use App\Filament\Widgets\LatestActivityLogsWidget;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use Tests\TestCase;

class ActivityLogTest extends TestCase
{
    use RefreshDatabase;

    public function test_activity_log_can_be_created_manually(): void
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@api-banyuwangi.ac.id',
        ]);

        $log = ActivityLog::record(
            userId: $user->id,
            actionType: 'INSERT',
            moduleName: 'Produk',
            description: 'Menambahkan produk baru: Laptop Asus',
            recordId: 45,
            newValues: ['nama' => 'Laptop Asus', 'harga' => 7500000, 'stok' => 10],
            ipAddress: '192.168.1.10'
        );

        $this->assertDatabaseHas('activity_logs', [
            'id' => $log->id,
            'user_id' => $user->id,
            'action_type' => 'INSERT',
            'module_name' => 'Produk',
            'record_id' => 45,
            'ip_address' => '192.168.1.10',
            'description' => 'Menambahkan produk baru: Laptop Asus',
        ]);

        $this->assertEquals(['nama' => 'Laptop Asus', 'harga' => 7500000, 'stok' => 10], $log->new_values);
    }

    public function test_activity_log_stores_update_with_old_and_new_values(): void
    {
        $log = ActivityLog::record(
            userId: 123,
            actionType: 'UPDATE',
            moduleName: 'Produk',
            description: 'Mengubah harga dan stok produk ID 45',
            recordId: 45,
            oldValues: ['harga' => 7500000, 'stok' => 10],
            newValues: ['harga' => 7000000, 'stok' => 8],
            ipAddress: '192.168.1.10'
        );

        $this->assertDatabaseHas('activity_logs', [
            'id' => $log->id,
            'user_id' => 123,
            'action_type' => 'UPDATE',
            'module_name' => 'Produk',
        ]);

        $this->assertEquals(['harga' => 7500000, 'stok' => 10], $log->fresh()->old_values);
        $this->assertEquals(['harga' => 7000000, 'stok' => 8], $log->fresh()->new_values);
    }

    public function test_login_event_automatically_logs_activity(): void
    {
        $user = User::factory()->create([
            'name' => 'Budi Santoso',
            'email' => 'budi@api-banyuwangi.ac.id',
        ]);

        Auth::login($user);

        $this->assertDatabaseHas('activity_logs', [
            'user_id' => $user->id,
            'action_type' => 'LOGIN',
            'module_name' => 'Authentication',
        ]);

        $log = ActivityLog::where('user_id', $user->id)->where('action_type', 'LOGIN')->first();
        $this->assertNotNull($log);
        $this->assertStringContainsString('Budi Santoso', $log->description);
    }

    public function test_logout_event_automatically_logs_activity(): void
    {
        $user = User::factory()->create([
            'name' => 'Budi Santoso',
            'email' => 'budi@api-banyuwangi.ac.id',
        ]);

        Auth::login($user);
        Auth::logout();

        $this->assertDatabaseHas('activity_logs', [
            'user_id' => $user->id,
            'action_type' => 'LOGOUT',
            'module_name' => 'Authentication',
        ]);
    }

    public function test_dashboard_renders_latest_activity_logs_widget(): void
    {
        $user = User::factory()->create([
            'email' => 'superadmin@api-banyuwangi.ac.id',
            'role' => 'super_admin',
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(200);
        $content = $response->getContent();

        $this->assertStringContainsString('LatestActivityLogsWidget', $content);
    }

    public function test_latest_activity_logs_widget_mounts_and_displays_logs(): void
    {
        $user = User::factory()->create(['role' => 'super_admin']);
        $this->actingAs($user);

        ActivityLog::create([
            'user_id' => $user->id,
            'action_type' => 'LOGIN',
            'module_name' => 'Authentication',
            'ip_address' => '127.0.0.1',
            'description' => 'Pengguna berhasil masuk ke sistem',
            'created_at' => now(),
        ]);

        Livewire::test(LatestActivityLogsWidget::class)
            ->assertSuccessful()
            ->assertSee('Activity & Login History')
            ->assertSee('Authentication')
            ->assertSee('127.0.0.1');
    }
}
