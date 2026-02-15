<?php

namespace App\Http\Controllers\Pamong;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityReport;
use App\Models\Attendance;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Statistik kehadiran bulan ini
        $attendanceThisMonth = Attendance::forUser($user->id)
            ->currentMonth()
            ->count();

        // Hari ini sudah clock in?
        $todayAttendance = Attendance::forUser($user->id)
            ->where('date', today())
            ->first();

        // Statistik laporan
        $totalReports = ActivityReport::forUser($user->id)->count();
        $pendingReports = ActivityReport::forUser($user->id)->pending()->count();
        $approvedReports = ActivityReport::forUser($user->id)->approved()->count();
        $rejectedReports = ActivityReport::forUser($user->id)->rejected()->count();

        // Laporan yang baru ditolak
        $recentRejected = ActivityReport::forUser($user->id)
            ->rejected()
            ->with('verifier')
            ->latest('verified_at')
            ->take(5)
            ->get();

        // Daftar kegiatan aktif dari TU
        $activities = Activity::active()
            ->currentMonth()
            ->orderBy('date')
            ->take(10)
            ->get();

        return view('pamong.dashboard', compact(
            'attendanceThisMonth',
            'todayAttendance',
            'totalReports',
            'pendingReports',
            'approvedReports',
            'rejectedReports',
            'recentRejected',
            'activities'
        ));
    }
}
