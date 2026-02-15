<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PerformanceReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reviewer_id',
        'period',
        'score',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'score' => 'decimal:2',
        ];
    }

    // ============================================
    // RELATIONSHIPS
    // ============================================

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    // ============================================
    // SCOPES
    // ============================================

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeForPeriod($query, $period)
    {
        return $query->where('period', $period);
    }

    // ============================================
    // HELPER METHODS
    // ============================================

    public function getScoreLabelAttribute(): string
    {
        return match (true) {
            $this->score >= 90 => 'Sangat Baik',
            $this->score >= 75 => 'Baik',
            $this->score >= 60 => 'Cukup',
            $this->score >= 50 => 'Kurang',
            default => 'Sangat Kurang',
        };
    }
}
