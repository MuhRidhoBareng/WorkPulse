<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Pamong\DashboardController as PamongDashboardController;
use App\Http\Controllers\Pamong\AttendanceController;
use App\Http\Controllers\Pamong\ActivityReportController;
use App\Http\Controllers\Kepala\DashboardController as KepalaDashboardController;
use App\Http\Controllers\Kepala\LaporanController;
use App\Http\Controllers\Kepala\RekapController as KepalaRekapController;
use App\Http\Controllers\Tu\RekapController as TuRekapController;
use App\Http\Controllers\Tu\PerformanceReviewController as TuPerformanceReviewController;
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
// KEPALA SKB ROUTES (read-only / monitoring)
// ============================================
Route::middleware(['auth', 'active', 'role:kepala_skb'])->prefix('kepala')->name('kepala.')->group(function () {
    Route::get('/dashboard', [KepalaDashboardController::class, 'index'])->name('dashboard');

    // Laporan ACC (read-only - approved reports only)
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

    // Rekap Kinerja (read-only)
    Route::get('/rekap', [KepalaRekapController::class, 'index'])->name('rekap.index');
    Route::get('/rekap/export', [KepalaRekapController::class, 'exportExcel'])->name('rekap.export');
});

// ============================================
// TU WEB ROUTES (rekap & evaluasi management)
// ============================================
Route::middleware(['auth', 'active', 'role:tu'])->prefix('tu')->name('tu.')->group(function () {
    // Rekap Kinerja (TU manages this now)
    Route::get('/rekap', [TuRekapController::class, 'index'])->name('rekap.index');
    Route::get('/rekap/export', [TuRekapController::class, 'exportExcel'])->name('rekap.export');

    // Evaluasi Kinerja (TU manages this now)
    Route::get('/evaluasi', [TuPerformanceReviewController::class, 'index'])->name('evaluasi.index');
    Route::get('/evaluasi/create', [TuPerformanceReviewController::class, 'create'])->name('evaluasi.create');
    Route::post('/evaluasi', [TuPerformanceReviewController::class, 'store'])->name('evaluasi.store');
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
