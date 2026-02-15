<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'clock_in',
        'clock_out',
        'latitude_in',
        'longitude_in',
        'clock_in_photo',
        'latitude_out',
        'longitude_out',
        'clock_out_photo',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'clock_in' => 'datetime',
            'clock_out' => 'datetime',
            'latitude_in' => 'decimal:8',
            'longitude_in' => 'decimal:8',
            'latitude_out' => 'decimal:8',
            'longitude_out' => 'decimal:8',
        ];
    }

    // ============================================
    // RELATIONSHIPS
    // ============================================

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // ============================================
    // SCOPES
    // ============================================

    public function scopeCurrentMonth($query)
    {
        return $query->whereMonth('date', now()->month)
                     ->whereYear('date', now()->year);
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // ============================================
    // HELPER METHODS
    // ============================================

    public function hasClockOut(): bool
    {
        return $this->clock_out !== null;
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'hadir' => 'Hadir',
            'izin' => 'Izin',
            'sakit' => 'Sakit',
            'alpha' => 'Alpha',
            default => $this->status,
        };
    }
}
