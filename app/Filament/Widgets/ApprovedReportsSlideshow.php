<?php

namespace App\Filament\Widgets;

use App\Models\ActivityReport;
use Filament\Widgets\Widget;

class ApprovedReportsSlideshow extends Widget
{
    protected static string $view = 'filament.widgets.approved-reports-slideshow';

    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function getViewData(): array
    {
        $reports = ActivityReport::with('user')
            ->where('status', 'approved')
            ->whereNotNull('document_path')
            ->latest('verified_at')
            ->take(10)
            ->get()
            ->filter(function ($report) {
                // Only include image-type documents
                $ext = strtolower(pathinfo($report->document_path, PATHINFO_EXTENSION));
                return in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif']);
            })
            ->map(function ($report) {
                return [
                    'id' => $report->id,
                    'title' => $report->title,
                    'description' => \Illuminate\Support\Str::limit($report->description, 100),
                    'pamong_name' => $report->user?->name ?? 'Unknown',
                    'date' => $report->activity_date ? $report->activity_date->format('d M Y') : '-',
                    'photo_url' => asset('storage/' . $report->document_path),
                ];
            })
            ->values();

        return [
            'reports' => $reports,
        ];
    }
}
