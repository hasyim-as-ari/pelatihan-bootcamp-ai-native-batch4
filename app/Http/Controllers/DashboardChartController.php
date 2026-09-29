<?php

namespace App\Http\Controllers;

use App\Models\FlightLog;
use App\Models\JadwalPenerbangan;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardChartController extends Controller
{
    public function chartData(Request $request): JsonResponse
    {
        $period = $request->get('period', '7days');

        $labels = [];
        $jadwal = [];
        $hours  = [];

        if ($period === '7days') {
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $labels[] = $date->format('d M');
                $count = JadwalPenerbangan::whereDate('tanggal', $date->toDateString())->count();
                $h = (float) FlightLog::whereDate('tanggal', $date->toDateString())->sum('durasi_terbang');
                if ($h == 0 && $count > 0) $h = $count * 1.5;
                $jadwal[] = $count;
                $hours[]  = round($h, 1);
            }

        } elseif ($period === 'month') {
            $start = Carbon::now()->startOfMonth();
            $end   = Carbon::now()->endOfMonth();
            for ($date = $start->copy(); $date->lte($end); $date->addDays(5)) {
                $periodEnd = $date->copy()->addDays(4)->min($end);
                $labels[] = $date->format('d') . '-' . $periodEnd->format('d M');
                $count = JadwalPenerbangan::whereBetween('tanggal', [$date->toDateString(), $periodEnd->toDateString()])->count();
                $h = (float) FlightLog::whereBetween('tanggal', [$date->toDateString(), $periodEnd->toDateString()])->sum('durasi_terbang');
                if ($h == 0 && $count > 0) $h = $count * 1.5;
                $jadwal[] = $count;
                $hours[]  = round($h, 1);
            }

        } else { // year
            $year = Carbon::now()->year;
            $monthNames = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            foreach (range(1, 12) as $m) {
                $labels[] = $monthNames[$m - 1];
                $count = JadwalPenerbangan::whereYear('tanggal', $year)->whereMonth('tanggal', $m)->count();
                $h = (float) FlightLog::whereYear('tanggal', $year)->whereMonth('tanggal', $m)->sum('durasi_terbang');
                if ($h == 0 && $count > 0) $h = $count * 1.5;
                $jadwal[] = $count;
                $hours[]  = round($h, 1);
            }
        }

        return response()->json(compact('labels', 'jadwal', 'hours'));
    }
}
