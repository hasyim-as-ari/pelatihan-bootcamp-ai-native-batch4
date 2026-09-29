<?php

namespace Tests\Feature;

use App\Filament\Pages\InstructorProfile;
use App\Filament\Pages\TarunaProfile;
use App\Filament\Resources\FlightHoursReport\FlightHoursReportResource;
use App\Models\ActivityLog;
use App\Models\AircraftDispatch;
use App\Models\BriefingDebriefing;
use App\Models\FlightLog;
use App\Models\Instruktur;
use App\Models\JadwalPenerbangan;
use App\Models\LicenseRating;
use App\Models\LoginHistory;
use App\Models\ModulPenerbangan;
use App\Models\NotificationBroadcast;
use App\Models\PengajuanReschedule;
use App\Models\PengaturanSistem;
use App\Models\Pesawat;
use App\Models\RuteAreaLatihan;
use App\Models\SlotWaktu;
use App\Models\Taruna;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class RoleAndPermissionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * Test super_admin role has full access to all models.
     */
    public function test_super_admin_has_full_access(): void
    {
        $superAdmin = User::where('role', 'super_admin')->first();
        $this->assertNotNull($superAdmin, 'Super Admin user must exist');
        $this->assertTrue($superAdmin->hasRole('super_admin'));
        $this->assertTrue($superAdmin->isSuperAdmin());

        // Master Data access
        $this->assertTrue(Gate::forUser($superAdmin)->allows('viewAny', Instruktur::class));
        $this->assertTrue(Gate::forUser($superAdmin)->allows('viewAny', Taruna::class));
        $this->assertTrue(Gate::forUser($superAdmin)->allows('viewAny', Pesawat::class));
        $this->assertTrue(Gate::forUser($superAdmin)->allows('viewAny', SlotWaktu::class));
        $this->assertTrue(Gate::forUser($superAdmin)->allows('viewAny', LicenseRating::class));
        $this->assertTrue(Gate::forUser($superAdmin)->allows('viewAny', RuteAreaLatihan::class));
        $this->assertTrue(Gate::forUser($superAdmin)->allows('viewAny', ModulPenerbangan::class));

        // Flight Operations access
        $this->assertTrue(Gate::forUser($superAdmin)->allows('viewAny', JadwalPenerbangan::class));
        $this->assertTrue(Gate::forUser($superAdmin)->allows('viewAny', FlightLog::class));
        $this->assertTrue(Gate::forUser($superAdmin)->allows('viewAny', PengajuanReschedule::class));
        $this->assertTrue(Gate::forUser($superAdmin)->allows('viewAny', BriefingDebriefing::class));
        $this->assertTrue(Gate::forUser($superAdmin)->allows('viewAny', AircraftDispatch::class));

        // Reports & History access
        $this->assertTrue(Gate::forUser($superAdmin)->allows('viewAny', ActivityLog::class));
        $this->assertTrue(Gate::forUser($superAdmin)->allows('viewAny', LoginHistory::class));

        // Settings access
        $this->assertTrue(Gate::forUser($superAdmin)->allows('viewAny', User::class));
        $this->assertTrue(Gate::forUser($superAdmin)->allows('viewAny', PengaturanSistem::class));
        $this->assertTrue(Gate::forUser($superAdmin)->allows('viewAny', NotificationBroadcast::class));
    }

    /**
     * Test admin_operasional role has operational and report access, but no master data or settings.
     */
    public function test_admin_operasional_permissions(): void
    {
        $adminOps = User::where('role', 'admin_operasional')->first();
        $this->assertNotNull($adminOps, 'Admin Operasional user must exist');
        $this->assertTrue($adminOps->hasRole('admin_operasional'));
        $this->assertTrue($adminOps->isAdminOperasional());

        // Master Data access DENIED
        $this->assertFalse(Gate::forUser($adminOps)->allows('viewAny', Instruktur::class));
        $this->assertFalse(Gate::forUser($adminOps)->allows('viewAny', Taruna::class));
        $this->assertFalse(Gate::forUser($adminOps)->allows('viewAny', Pesawat::class));
        $this->assertFalse(Gate::forUser($adminOps)->allows('viewAny', SlotWaktu::class));
        $this->assertFalse(Gate::forUser($adminOps)->allows('viewAny', LicenseRating::class));
        $this->assertFalse(Gate::forUser($adminOps)->allows('viewAny', RuteAreaLatihan::class));
        $this->assertFalse(Gate::forUser($adminOps)->allows('viewAny', ModulPenerbangan::class));

        // Settings access DENIED
        $this->assertFalse(Gate::forUser($adminOps)->allows('viewAny', User::class));
        $this->assertFalse(Gate::forUser($adminOps)->allows('viewAny', PengaturanSistem::class));
        $this->assertFalse(Gate::forUser($adminOps)->allows('viewAny', NotificationBroadcast::class));

        // Flight Operations access ALLOWED
        $this->assertTrue(Gate::forUser($adminOps)->allows('viewAny', JadwalPenerbangan::class));
        $this->assertTrue(Gate::forUser($adminOps)->allows('viewAny', FlightLog::class));
        $this->assertTrue(Gate::forUser($adminOps)->allows('viewAny', PengajuanReschedule::class));
        $this->assertTrue(Gate::forUser($adminOps)->allows('viewAny', BriefingDebriefing::class));
        $this->assertTrue(Gate::forUser($adminOps)->allows('viewAny', AircraftDispatch::class));

        // Reports & History access ALLOWED
        $this->assertTrue(Gate::forUser($adminOps)->allows('viewAny', ActivityLog::class));
        $this->assertTrue(Gate::forUser($adminOps)->allows('viewAny', LoginHistory::class));
    }

    /**
     * Test instruktur role has flight schedules, briefing, and flight logs access only.
     */
    public function test_instruktur_permissions(): void
    {
        $instruktur = User::where('role', 'instruktur')->first();
        $this->assertNotNull($instruktur, 'Instruktur user must exist');
        $this->assertTrue($instruktur->hasRole('instruktur'));
        $this->assertTrue($instruktur->isInstruktur());

        // Master Data access DENIED
        $this->assertFalse(Gate::forUser($instruktur)->allows('viewAny', Instruktur::class));
        $this->assertFalse(Gate::forUser($instruktur)->allows('viewAny', Taruna::class));
        $this->assertFalse(Gate::forUser($instruktur)->allows('viewAny', Pesawat::class));
        $this->assertFalse(Gate::forUser($instruktur)->allows('viewAny', SlotWaktu::class));

        // Settings access DENIED
        $this->assertFalse(Gate::forUser($instruktur)->allows('viewAny', User::class));
        $this->assertFalse(Gate::forUser($instruktur)->allows('viewAny', PengaturanSistem::class));

        // Aircraft Dispatch DENIED
        $this->assertFalse(Gate::forUser($instruktur)->allows('viewAny', AircraftDispatch::class));

        // Reschedule Requests DENIED (not in Instruktur menu)
        $this->assertFalse(Gate::forUser($instruktur)->allows('viewAny', PengajuanReschedule::class));

        // Activity Logs and Login History DENIED
        $this->assertFalse(Gate::forUser($instruktur)->allows('viewAny', ActivityLog::class));
        $this->assertFalse(Gate::forUser($instruktur)->allows('viewAny', LoginHistory::class));

        // Flight Operations ALLOWED for Instruktur
        $this->assertTrue(Gate::forUser($instruktur)->allows('viewAny', JadwalPenerbangan::class));
        $this->assertTrue(Gate::forUser($instruktur)->allows('viewAny', BriefingDebriefing::class));
        $this->assertTrue(Gate::forUser($instruktur)->allows('viewAny', FlightLog::class));

        // My Profile & Availability ALLOWED for Instruktur, Taruna Profile DENIED
        $this->actingAs($instruktur);
        $this->assertTrue(InstructorProfile::canAccess());
        $this->assertFalse(TarunaProfile::canAccess());
        $this->assertFalse(FlightHoursReportResource::canViewAny());
    }

    /**
     * Test taruna role has schedules and reschedule requests access, but no flight logs, briefing, or dispatch.
     */
    public function test_taruna_permissions(): void
    {
        $taruna = User::where('role', 'taruna')->first();
        $this->assertNotNull($taruna, 'Taruna user must exist');
        $this->assertTrue($taruna->hasRole('taruna'));
        $this->assertTrue($taruna->isTaruna());

        // Master Data access DENIED
        $this->assertFalse(Gate::forUser($taruna)->allows('viewAny', Instruktur::class));
        $this->assertFalse(Gate::forUser($taruna)->allows('viewAny', Taruna::class));
        $this->assertFalse(Gate::forUser($taruna)->allows('viewAny', Pesawat::class));

        // Settings access DENIED
        $this->assertFalse(Gate::forUser($taruna)->allows('viewAny', User::class));
        $this->assertFalse(Gate::forUser($taruna)->allows('viewAny', PengaturanSistem::class));

        // Flight Operations DENIED for Taruna
        $this->assertFalse(Gate::forUser($taruna)->allows('viewAny', FlightLog::class));
        $this->assertFalse(Gate::forUser($taruna)->allows('viewAny', BriefingDebriefing::class));
        $this->assertFalse(Gate::forUser($taruna)->allows('viewAny', AircraftDispatch::class));

        // Reports DENIED for Taruna
        $this->assertFalse(Gate::forUser($taruna)->allows('viewAny', ActivityLog::class));
        $this->assertFalse(Gate::forUser($taruna)->allows('viewAny', LoginHistory::class));

        // Taruna ALLOWED: Schedules, Reschedule Requests, Training Progress / Reports
        $this->assertTrue(Gate::forUser($taruna)->allows('viewAny', JadwalPenerbangan::class));
        $this->assertTrue(Gate::forUser($taruna)->allows('viewAny', PengajuanReschedule::class));

        // Profile & Report checks
        $this->actingAs($taruna);
        $this->assertTrue(TarunaProfile::canAccess());
        $this->assertFalse(InstructorProfile::canAccess());
        $this->assertTrue(FlightHoursReportResource::canViewAny());
    }

    /**
     * Test /admin/dashboard redirects to /admin seamlessly for logged in user.
     */
    public function test_admin_dashboard_url_redirects_to_admin(): void
    {
        $superAdmin = User::where('role', 'super_admin')->first();

        $response = $this->actingAs($superAdmin)->get('/admin/dashboard');
        $response->assertRedirect('/admin');

        $follow = $this->actingAs($superAdmin)->get('/admin');
        $follow->assertStatus(200);
    }
}
