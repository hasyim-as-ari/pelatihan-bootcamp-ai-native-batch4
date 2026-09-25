<?php

namespace App\Filament\Widgets;

use App\Models\Pesawat;
use Filament\Widgets\ChartWidget;

class StatusPesawatChart extends ChartWidget
{
    protected static ?int $sort = 3;

    protected ?string $heading = 'Aircraft Fleet Readiness';

    protected ?string $description = 'Airworthiness distribution of API Banyuwangi training fleet';

    protected int | string | array $columnSpan = [
        'md' => 1,
        'xl' => 1,
    ];

    protected function getData(): array
    {
        $available = Pesawat::where('status', 'available')->count();
        $inUse = Pesawat::where('status', 'in_use')->count();
        $maintenance = Pesawat::where('status', 'maintenance')->count();
        $grounded = Pesawat::where('status', 'grounded')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Units Count',
                    'data' => [$available, $inUse, $maintenance, $grounded],
                    'backgroundColor' => [
                        '#10b981', // Available (Green)
                        '#0066ee', // In Flight / In Use (Brand Blue)
                        '#f59e0b', // Maintenance (Yellow)
                        '#ef4444', // Grounded (Red)
                    ],
                    'borderWidth' => 2,
                    'borderColor' => '#ffffff',
                ],
            ],
            'labels' => ['Available', 'In Flight', 'Maintenance', 'Grounded'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
