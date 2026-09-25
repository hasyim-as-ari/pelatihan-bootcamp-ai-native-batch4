<?php

namespace App\Filament\Widgets;

use App\Models\FlightLog;
use App\Models\JadwalPenerbangan;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class JadwalPenerbanganChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected ?string $heading = 'Flight Activity & Hours Trend';

    protected ?string $description = 'Comparative statistics of flight schedules and accumulated flight hours';

    protected int | string | array $columnSpan = [
        'md' => 1,
        'xl' => 2,
    ];

    public ?string $filter = '7days';

    protected function getFilters(): ?array
    {
        return [
            '7days' => 'Last 7 Days',
            'month' => 'This Month',
            'year' => 'This Year',
        ];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter ?? '7days';

        $labels = [];
        $jadwalData = [];
        $hoursData = [];

        if ($activeFilter === '7days') {
            // Last 7 Days (D-6 to Today)
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $dateStr = $date->toDateString();
                $labels[] = $date->format('d M');

                $count = JadwalPenerbangan::whereDate('tanggal', $dateStr)->count();
                $hours = (float) FlightLog::whereDate('tanggal', $dateStr)->sum('durasi_terbang');

                if ($hours == 0 && $count > 0) {
                    $hours = $count * 1.5;
                }

                $jadwalData[] = $count;
                $hoursData[] = round($hours, 1);
            }
        } elseif ($activeFilter === 'month') {
            // Per week block in current month
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();

            for ($date = $startOfMonth->copy(); $date->lte($endOfMonth); $date->addDays(5)) {
                $periodEnd = $date->copy()->addDays(4)->min($endOfMonth);
                $labels[] = $date->format('d') . '-' . $periodEnd->format('d M');

                $count = JadwalPenerbangan::whereBetween('tanggal', [$date->toDateString(), $periodEnd->toDateString()])->count();
                $hours = (float) FlightLog::whereBetween('tanggal', [$date->toDateString(), $periodEnd->toDateString()])->sum('durasi_terbang');

                if ($hours == 0 && $count > 0) {
                    $hours = $count * 1.5;
                }

                $jadwalData[] = $count;
                $hoursData[] = round($hours, 1);
            }
        } else {
            // 12 Months of the current year
            $currentYear = Carbon::now()->year;
            $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            foreach (range(1, 12) as $m) {
                $labels[] = $monthNames[$m - 1];

                $count = JadwalPenerbangan::whereYear('tanggal', $currentYear)->whereMonth('tanggal', $m)->count();
                $hours = (float) FlightLog::whereYear('tanggal', $currentYear)->whereMonth('tanggal', $m)->sum('durasi_terbang');

                if ($hours == 0 && $count > 0) {
                    $hours = $count * 1.5;
                }

                $jadwalData[] = $count;
                $hoursData[] = round($hours, 1);
            }
        }

        return [
            'datasets' => [
                [
                    'label' => 'Flight Schedules',
                    'data' => $jadwalData,
                    'backgroundColor' => 'rgba(0, 102, 238, 0.85)',
                    'borderColor' => '#0066ee',
                    'borderWidth' => 2,
                    'borderRadius' => 6,
                ],
                [
                    'label' => 'Flight Hours (Hrs)',
                    'data' => $hoursData,
                    'backgroundColor' => 'rgba(16, 185, 129, 0.85)',
                    'borderColor' => '#10b981',
                    'borderWidth' => 2,
                    'borderRadius' => 6,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
