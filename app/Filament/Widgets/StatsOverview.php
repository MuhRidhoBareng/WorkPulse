<?php

namespace App\Filament\Widgets;

use App\Models\ActivityReport;
use App\Models\Attendance;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalPamong = User::where('role', 'pamong')->count();
        $activePamong = User::where('role', 'pamong')->where('is_active', true)->count();
        $inactivePamong = $totalPamong - $activePamong;

        $todayAttendance = Attendance::whereDate('date', today())->where('status', 'hadir')->count();

        $pendingReports = ActivityReport::where('status', 'pending')->count();
        $approvedThisMonth = ActivityReport::where('status', 'approved')
            ->whereMonth('activity_date', now()->month)
            ->whereYear('activity_date', now()->year)
            ->count();

        $todayClockIn = Attendance::whereDate('date', today())->count();
        $todayClockOut = Attendance::whereDate('date', today())->whereNotNull('clock_out')->count();

        return [
            Stat::make('Total Pamong', $totalPamong)
                ->description("{$activePamong} aktif · {$inactivePamong} nonaktif")
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->chart($this->getUserTrend()),

            Stat::make('Kehadiran Hari Ini', "{$todayAttendance} / {$activePamong}")
                ->description($activePamong > 0 ? round(($todayAttendance / $activePamong) * 100) . '% hadir' : '0%')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color($todayAttendance >= $activePamong ? 'success' : 'warning')
                ->chart($this->getAttendanceTrend()),

            Stat::make('Clock In / Out Hari Ini', "{$todayClockIn} / {$todayClockOut}")
                ->description(($todayClockIn - $todayClockOut) . ' belum clock out')
                ->descriptionIcon('heroicon-m-clock')
                ->color($todayClockIn === $todayClockOut ? 'success' : 'info'),

            Stat::make('Laporan Pending', $pendingReports)
                ->description("{$approvedThisMonth} disetujui bulan ini")
                ->descriptionIcon('heroicon-m-document-text')
                ->color($pendingReports > 0 ? 'warning' : 'success')
                ->chart($this->getReportTrend()),
        ];
    }

    private function getUserTrend(): array
    {
        // New users per day for last 7 days
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $data[] = User::where('role', 'pamong')
                ->whereDate('created_at', now()->subDays($i))
                ->count();
        }
        return $data;
    }

    private function getAttendanceTrend(): array
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $data[] = Attendance::whereDate('date', now()->subDays($i))
                ->where('status', 'hadir')
                ->count();
        }
        return $data;
    }

    private function getReportTrend(): array
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $data[] = ActivityReport::whereDate('created_at', now()->subDays($i))->count();
        }
        return $data;
    }
}
