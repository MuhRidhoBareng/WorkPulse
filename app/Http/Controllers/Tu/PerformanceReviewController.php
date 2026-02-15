<?php

namespace App\Http\Controllers\Tu;

use App\Http\Controllers\Controller;
use App\Models\PerformanceReview;
use App\Models\User;
use Illuminate\Http\Request;

class PerformanceReviewController extends Controller
{
    public function index()
    {
        $reviews = PerformanceReview::with(['user', 'reviewer'])
            ->latest()
            ->paginate(10);

        return view('tu.evaluasi.index', compact('reviews'));
    }

    public function create()
    {
        $pamongs = User::where('role', 'pamong')
            ->where('is_active', true)
            ->get();

        return view('tu.evaluasi.create', compact('pamongs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'period' => 'required|string|max:10',
            'score' => 'required|numeric|min:0|max:100',
            'notes' => 'nullable|string',
        ], [
            'user_id.required' => 'Pilih Pamong yang akan dievaluasi.',
            'period.required' => 'Periode evaluasi wajib diisi.',
            'score.required' => 'Skor evaluasi wajib diisi.',
            'score.min' => 'Skor minimal 0.',
            'score.max' => 'Skor maksimal 100.',
        ]);

        $existing = PerformanceReview::where('user_id', $validated['user_id'])
            ->where('period', $validated['period'])
            ->first();

        if ($existing) {
            return back()->withErrors(['period' => 'Evaluasi untuk Pamong ini pada periode tersebut sudah ada.'])
                ->withInput();
        }

        PerformanceReview::create([
            'user_id' => $validated['user_id'],
            'reviewer_id' => auth()->id(),
            'period' => $validated['period'],
            'score' => $validated['score'],
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('tu.evaluasi.index')
            ->with('success', 'Evaluasi berhasil disimpan.');
    }
}
