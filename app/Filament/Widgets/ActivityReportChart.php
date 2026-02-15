<?php

namespace App\Filament\Widgets;

use App\Models\ActivityReport;
use Filament\Widgets\ChartWidget;

class ActivityReportChart extends ChartWidget
{
    protected static ?string $heading = 'Laporan Kegiatan Bulan Ini';
    protected static ?int $sort = 3;
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $approved = ActivityReport::where('status', 'approved')
            ->whereMonth('activity_date', now()->month)
            ->whereYear('activity_date', now()->year)
            ->count();

        $pending = ActivityReport::where('status', 'pending')
            ->whereMonth('activity_date', now()->month)
            ->whereYear('activity_date', now()->year)
            ->count();

        $rejected = ActivityReport::where('status', 'rejected')
            ->whereMonth('activity_date', now()->month)
            ->whereYear('activity_date', now()->year)
            ->count();

        return [
            'datasets' => [
                [
                    'data' => [$approved, $pending, $rejected],
                    'backgroundColor' => ['#22c55e', '#f59e0b', '#ef4444'],
                    'borderColor' => ['#16a34a', '#d97706', '#dc2626'],
                    'borderWidth' => 2,
                ],
            ],
            'labels' => ['Disetujui', 'Menunggu', 'Ditolak'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
