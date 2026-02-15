<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use App\Models\ActivityReport;
use App\Models\Attendance;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Jumlah total Pamong aktif
        $totalPamong = User::where('role', 'pamong')->where('is_active', true)->count();

        // Kehadiran hari ini
        $todayAttendance = Attendance::where('date', today())->count();

        // Laporan pending
        $pendingReports = ActivityReport::pending()->count();

        // Laporan approved bulan ini
        $approvedThisMonth = ActivityReport::approved()
            ->whereMonth('verified_at', now()->month)
            ->whereYear('verified_at', now()->year)
            ->count();

        return view('kepala.dashboard', compact(
            'totalPamong',
            'todayAttendance',
            'pendingReports',
            'approvedThisMonth'
        ));
    }
}
