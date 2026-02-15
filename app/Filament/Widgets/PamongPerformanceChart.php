<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use App\Models\User;
use Filament\Widgets\ChartWidget;

class PamongPerformanceChart extends ChartWidget
{
    protected static ?string $heading = 'Performa Kehadiran per Pamong (Bulan Ini)';
    protected static ?int $sort = 4;
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $pamongs = User::where('role', 'pamong')->where('is_active', true)->get();

        $labels = [];
        $hadirData = [];
        $absenData = [];

        $month = now()->month;
        $year = now()->year;

        // Count workdays
        $start = \Carbon\Carbon::create($year, $month, 1);
        $end = $start->copy()->endOfMonth();
        $workdays = 0;
        $tempDate = $start->copy();
        while ($tempDate->lte($end)) {
            if ($tempDate->isWeekday()) $workdays++;
            $tempDate->addDay();
        }

        foreach ($pamongs as $pamong) {
            $labels[] = explode(' ', $pamong->name)[0]; // First name only
            $hadir = Attendance::where('user_id', $pamong->id)
                ->whereMonth('date', $month)
                ->whereYear('date', $year)
                ->where('status', 'hadir')
                ->count();
            $hadirData[] = $hadir;
            $absenData[] = max(0, $workdays - $hadir);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Hadir',
                    'data' => $hadirData,
                    'backgroundColor' => '#22c55e',
                    'borderRadius' => 4,
                ],
                [
                    'label' => 'Tidak Hadir',
                    'data' => $absenData,
                    'backgroundColor' => '#fca5a5',
                    'borderRadius' => 4,
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
