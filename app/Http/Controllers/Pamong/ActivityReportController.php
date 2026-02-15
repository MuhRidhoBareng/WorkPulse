<?php

namespace App\Http\Controllers\Pamong;

use App\Http\Controllers\Controller;
use App\Models\ActivityReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityReportController extends Controller
{
    public function index()
    {
        $reports = ActivityReport::forUser(auth()->id())
            ->with('verifier')
            ->latest()
            ->paginate(10);

        return view('pamong.reports.index', compact('reports'));
    }

    public function create()
    {
        return view('pamong.reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'activity_date' => 'required|date',
            'document' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ], [
            'title.required' => 'Judul kegiatan wajib diisi.',
            'description.required' => 'Deskripsi kegiatan wajib diisi.',
            'activity_date.required' => 'Tanggal kegiatan wajib diisi.',
            'document.mimes' => 'File bukti harus berformat PDF, JPG, JPEG, atau PNG.',
            'document.max' => 'Ukuran file maksimal 2MB.',
        ]);

        $documentPath = null;
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('activity-documents', 'public');
        }

        ActivityReport::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'activity_date' => $validated['activity_date'],
            'document_path' => $documentPath,
            'status' => 'pending',
        ]);

        return redirect()->route('pamong.reports.index')
            ->with('success', 'Laporan kegiatan berhasil dikirim dan menunggu verifikasi.');
    }

    public function show(ActivityReport $report)
    {
        // Pastikan Pamong hanya bisa lihat laporan miliknya
        if ($report->user_id !== auth()->id()) {
            abort(403);
        }

        return view('pamong.reports.show', compact('report'));
    }
}
