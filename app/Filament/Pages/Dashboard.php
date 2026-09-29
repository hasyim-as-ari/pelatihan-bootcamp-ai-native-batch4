<?php

namespace App\Filament\Pages;

use App\Models\ActivityLog;
use App\Models\FlightLog;
use App\Models\JadwalPenerbangan;
use App\Models\PengajuanReschedule;
use App\Models\Pesawat;
use App\Models\Taruna;
use BackedEnum;
use Carbon\Carbon;
use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $title = 'Dashboard';
    protected static string $routePath = '/';
    protected static ?int $navigationSort = -2;

    protected string $view = 'filament.pages.dashboard';

    public function getViewData(): array
    {
        $today = now()->toDateString();

        // Today's flights
        $todaySchedules = JadwalPenerbangan::whereDate('tanggal', $today)->count();
        $inFlight = JadwalPenerbangan::whereDate('tanggal', $today)->where('status', 'in_flight')->count();
        $done = JadwalPenerbangan::whereDate('tanggal', $today)->where('status', 'completed')->count();
        $scheduled = JadwalPenerbangan::whereDate('tanggal', $today)->where('status', 'scheduled')->count();

        // Total flight hours
        $totalHours = (float) (FlightLog::sum('durasi_terbang') ?: Taruna::sum('total_jam_terbang'));

        // Last month comparison
        $lastMonthStart = now()->subMonth()->startOfMonth()->toDateString();
        $lastMonthEnd = now()->subMonth()->endOfMonth()->toDateString();
        $lastMonthHours = (float) FlightLog::whereBetween('tanggal', [$lastMonthStart, $lastMonthEnd])->sum('durasi_terbang');
        $thisMonthStart = now()->startOfMonth()->toDateString();
        $thisMonthHours = (float) FlightLog::whereBetween('tanggal', [$thisMonthStart, $today])->sum('durasi_terbang');
        $hoursGrowth = $lastMonthHours > 0 ? round((($thisMonthHours - $lastMonthHours) / $lastMonthHours) * 100, 1) : 0;

        // Fleet readiness
        $totalPesawat = Pesawat::count();
        $readyPesawat = Pesawat::whereIn('status', ['available', 'in_use'])->count();
        $maintenancePesawat = Pesawat::whereIn('status', ['maintenance', 'grounded'])->count();
        $readyPercent = $totalPesawat > 0 ? round(($readyPesawat / $totalPesawat) * 100) : 0;
        $available = Pesawat::where('status', 'available')->count();
        $inUse = Pesawat::where('status', 'in_use')->count();
        $maintenance = Pesawat::where('status', 'maintenance')->count();
        $grounded = Pesawat::where('status', 'grounded')->count();

        // Reschedule requests
        $pendingReschedule = PengajuanReschedule::where('status', 'pending')->count();

        // Chart data (last 7 days)
        $chartLabels = [];
        $chartJadwal = [];
        $chartHours = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $chartLabels[] = $date->format('d M');
            $count = JadwalPenerbangan::whereDate('tanggal', $date->toDateString())->count();
            $hours = (float) FlightLog::whereDate('tanggal', $date->toDateString())->sum('durasi_terbang');
            if ($hours == 0 && $count > 0) $hours = $count * 1.5;
            $chartJadwal[] = $count;
            $chartHours[] = round($hours, 1);
        }

        // Recent schedules
        $recentSchedules = JadwalPenerbangan::with(['taruna', 'instruktur', 'pesawat'])
            ->latest('tanggal')
            ->latest('jam_mulai')
            ->limit(5)
            ->get();

        // Latest activity logs
        $latestActivities = ActivityLog::with('user')
            ->latest('id')
            ->limit(4)
            ->get();

        return [
            'today' => now()->format('d M Y'),
            'todaySchedules' => $todaySchedules,
            'inFlight' => $inFlight,
            'done' => $done,
            'scheduled' => $scheduled,
            'totalHours' => $totalHours,
            'hoursGrowth' => $hoursGrowth,
            'totalPesawat' => $totalPesawat,
            'readyPesawat' => $readyPesawat,
            'maintenancePesawat' => $maintenancePesawat,
            'readyPercent' => $readyPercent,
            'available' => $available,
            'inUse' => $inUse,
            'maintenance' => $maintenance,
            'grounded' => $grounded,
            'pendingReschedule' => $pendingReschedule,
            'chartLabels' => $chartLabels,
            'chartJadwal' => $chartJadwal,
            'chartHours' => $chartHours,
            'recentSchedules' => $recentSchedules,
            'latestActivities' => $latestActivities,
        ];
    }
}
