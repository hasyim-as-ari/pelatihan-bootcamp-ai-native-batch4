<?php

namespace App\Filament\Widgets;

use App\Models\FlightLog;
use App\Models\JadwalPenerbangan;
use App\Models\PengajuanReschedule;
use App\Models\Pesawat;
use App\Models\Taruna;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FlightStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $today = now()->toDateString();

        // 1. Jadwal Hari Ini & Status Aktif
        $todaySchedules = JadwalPenerbangan::whereDate('tanggal', $today)->count();
        $activeSchedules = JadwalPenerbangan::whereIn('status', ['scheduled', 'in_flight'])->count();
        $completedSchedules = JadwalPenerbangan::where('status', 'completed')->count();

        // 2. Realisasi Jam Terbang Kadet
        $totalHours = (float) (FlightLog::sum('durasi_terbang') ?: Taruna::sum('total_jam_terbang'));

        // 3. Kesiapan Armada Pesawat
        $totalPesawat = Pesawat::count();
        $readyPesawat = Pesawat::whereIn('status', ['available', 'in_use'])->count();
        $maintenancePesawat = Pesawat::whereIn('status', ['maintenance', 'grounded'])->count();

        // 4. Pengajuan Reschedule Menunggu
        $pendingReschedule = PengajuanReschedule::where('status', 'menunggu')->count();
        $approvedReschedule = PengajuanReschedule::where('status', 'disetujui')->count();

        return [
            Stat::make("Today's Flights", $todaySchedules . ' Flights')
                ->description("{$activeSchedules} active/scheduled, {$completedSchedules} completed")
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('primary')
                ->chart([3, 5, 4, 6, 8, 5, $todaySchedules ?: 6]),

            Stat::make('Total Flight Hours', number_format($totalHours, 1, '.', ',') . ' Hrs')
                ->description('Accumulated student flight time')
                ->descriptionIcon('heroicon-m-clock')
                ->color('success')
                ->chart([12, 18, 24, 30, 38, 44, (int) $totalHours ?: 52]),

            Stat::make('Fleet Readiness', "{$readyPesawat} / {$totalPesawat} Units Ready")
                ->description($maintenancePesawat > 0 ? "{$maintenancePesawat} units in maintenance / grounded" : 'All fleet operational & airworthy')
                ->descriptionIcon('heroicon-m-paper-airplane')
                ->color($readyPesawat === $totalPesawat ? 'success' : 'info')
                ->chart([7, 7, 6, 6, 7, 5, $readyPesawat]),

            Stat::make('Reschedule Requests', "{$pendingReschedule} Requests")
                ->description($pendingReschedule > 0 ? 'Pending dispatch verification' : "{$approvedReschedule} requests approved")
                ->descriptionIcon($pendingReschedule > 0 ? 'heroicon-m-exclamation-circle' : 'heroicon-m-check-circle')
                ->color($pendingReschedule > 0 ? 'warning' : 'success')
                ->chart([1, 2, 0, 1, 3, 2, $pendingReschedule]),
        ];
    }
}
