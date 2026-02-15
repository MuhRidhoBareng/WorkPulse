<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Pamong\DashboardController as PamongDashboardController;
use App\Http\Controllers\Pamong\AttendanceController;
use App\Http\Controllers\Pamong\ActivityReportController;
use App\Http\Controllers\Kepala\DashboardController as KepalaDashboardController;
use App\Http\Controllers\Kepala\RekapController;
use App\Http\Controllers\Kepala\PerformanceReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// Dashboard redirect berdasarkan role
Route::get('/dashboard', function () {
    $user = auth()->user();

    return match ($user->role) {
        'pamong' => redirect()->route('pamong.dashboard'),
        'tu' => redirect('/admin'), // Filament panel
        'kepala_skb' => redirect()->route('kepala.dashboard'),
        default => view('dashboard'),
    };
})->middleware(['auth', 'active'])->name('dashboard');

// ============================================
// PAMONG ROUTES
// ============================================
Route::middleware(['auth', 'active', 'role:pamong'])->prefix('pamong')->name('pamong.')->group(function () {
    Route::get('/dashboard', [PamongDashboardController::class, 'index'])->name('dashboard');

    // Kehadiran
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance/clock-in', [AttendanceController::class, 'clockIn'])->name('attendance.clockIn');
    Route::post('/attendance/clock-out', [AttendanceController::class, 'clockOut'])->name('attendance.clockOut');

    // Laporan Kegiatan
    Route::get('/reports', [ActivityReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/create', [ActivityReportController::class, 'create'])->name('reports.create');
    Route::post('/reports', [ActivityReportController::class, 'store'])->name('reports.store');
    Route::get('/reports/{report}', [ActivityReportController::class, 'show'])->name('reports.show');
});

// ============================================
// KEPALA SKB ROUTES
// ============================================
Route::middleware(['auth', 'active', 'role:kepala_skb'])->prefix('kepala')->name('kepala.')->group(function () {
    Route::get('/dashboard', [KepalaDashboardController::class, 'index'])->name('dashboard');

    // Rekap
    Route::get('/rekap', [RekapController::class, 'index'])->name('rekap.index');
    Route::get('/rekap/export', [RekapController::class, 'exportExcel'])->name('rekap.export');

    // Evaluasi
    Route::get('/evaluasi', [PerformanceReviewController::class, 'index'])->name('evaluasi.index');
    Route::get('/evaluasi/create', [PerformanceReviewController::class, 'create'])->name('evaluasi.create');
    Route::post('/evaluasi', [PerformanceReviewController::class, 'store'])->name('evaluasi.store');
});

// ============================================
// PROFILE ROUTES (semua role)
// ============================================
Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::delete('/profile/photo', [ProfileController::class, 'deletePhoto'])->name('profile.photo.delete');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
