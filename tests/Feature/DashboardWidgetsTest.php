<?php

namespace Tests\Feature;

use App\Filament\Widgets\FlightStatsOverview;
use App\Filament\Widgets\JadwalPenerbanganChart;
use App\Filament\Widgets\LatestJadwalWidget;
use App\Filament\Widgets\StatusPesawatChart;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class DashboardWidgetsTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_renders_all_widgets_successfully(): void
    {
        $user = User::factory()->create([
            'email' => 'superadmin@api-banyuwangi.ac.id',
            'password' => bcrypt('password'),
            'role' => 'super_admin',
            'is_active' => true,
        ]);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(200);
        $content = $response->getContent();

        // Verify widget components are registered on the dashboard page
        $this->assertStringContainsString('FlightStatsOverview', $content);
        $this->assertStringContainsString('JadwalPenerbanganChart', $content);
        $this->assertStringContainsString('StatusPesawatChart', $content);
        $this->assertStringContainsString('LatestActivityLogsWidget', $content);
        $this->assertStringContainsString('LatestJadwalWidget', $content);
    }

    public function test_stats_overview_widget_mounts(): void
    {
        $user = User::factory()->create(['role' => 'super_admin']);
        $this->actingAs($user);

        Livewire::test(FlightStatsOverview::class)
            ->assertSuccessful()
            ->assertSee("Today's Flights")
            ->assertSee('Total Flight Hours')
            ->assertSee('Fleet Readiness')
            ->assertSee('Reschedule Requests');
    }

    public function test_jadwal_chart_widget_mounts(): void
    {
        $user = User::factory()->create(['role' => 'super_admin']);
        $this->actingAs($user);

        Livewire::test(JadwalPenerbanganChart::class)
            ->assertSuccessful()
            ->assertSee('Flight Activity & Hours Trend');
    }

    public function test_status_pesawat_chart_widget_mounts(): void
    {
        $user = User::factory()->create(['role' => 'super_admin']);
        $this->actingAs($user);

        Livewire::test(StatusPesawatChart::class)
            ->assertSuccessful()
            ->assertSee('Aircraft Fleet Readiness');
    }

    public function test_latest_jadwal_widget_mounts(): void
    {
        $user = User::factory()->create(['role' => 'super_admin']);
        $this->actingAs($user);

        Livewire::test(LatestJadwalWidget::class)
            ->assertSuccessful()
            ->assertSee('Recent Flight Schedules');
    }
}
