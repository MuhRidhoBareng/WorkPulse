<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use App\Models\ActivityReport;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display approved activity reports (read-only for Kepala SKB).
     */
    public function index(Request $request)
    {
        $month = (int) $request->get('month', now()->month);
        $year = (int) $request->get('year', now()->year);

        $reports = ActivityReport::with(['user', 'verifier'])
            ->where('status', 'approved')
            ->whereMonth('activity_date', $month)
            ->whereYear('activity_date', $year)
            ->latest('activity_date')
            ->paginate(15);

        return view('kepala.laporan.index', compact('reports', 'month', 'year'));
    }
}
