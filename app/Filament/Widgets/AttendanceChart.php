<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use App\Models\User;
use Filament\Widgets\ChartWidget;

class AttendanceChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Kehadiran 30 Hari Terakhir';
    protected static ?int $sort = 2;
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $labels = [];
        $hadir = [];
        $izin = [];
        $sakit = [];
        $alpha = [];

        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $labels[] = $date->format('d/m');

            $hadir[] = Attendance::whereDate('date', $date)->where('status', 'hadir')->count();
            $izin[] = Attendance::whereDate('date', $date)->where('status', 'izin')->count();
            $sakit[] = Attendance::whereDate('date', $date)->where('status', 'sakit')->count();
            $alpha[] = Attendance::whereDate('date', $date)->where('status', 'alpha')->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Hadir',
                    'data' => $hadir,
                    'borderColor' => '#22c55e',
                    'backgroundColor' => 'rgba(34, 197, 94, 0.1)',
                    'fill' => true,
                    'tension' => 0.3,
                ],
                [
                    'label' => 'Izin',
                    'data' => $izin,
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'fill' => true,
                    'tension' => 0.3,
                ],
                [
                    'label' => 'Sakit',
                    'data' => $sakit,
                    'borderColor' => '#f59e0b',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.1)',
                    'fill' => true,
                    'tension' => 0.3,
                ],
                [
                    'label' => 'Alpha',
                    'data' => $alpha,
                    'borderColor' => '#ef4444',
                    'backgroundColor' => 'rgba(239, 68, 68, 0.1)',
                    'fill' => true,
                    'tension' => 0.3,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
