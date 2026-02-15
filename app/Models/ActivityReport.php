<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'activity_date',
        'document_path',
        'status',
        'rejection_reason',
        'verified_by',
        'verified_at',
    ];

    protected function casts(): array
    {
        return [
            'activity_date' => 'date',
            'verified_at' => 'datetime',
        ];
    }

    // ============================================
    // RELATIONSHIPS
    // ============================================

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    // ============================================
    // SCOPES
    // ============================================

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // ============================================
    // HELPER METHODS
    // ============================================

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    public function approve(int $verifierId): void
    {
        $this->update([
            'status' => 'approved',
            'verified_by' => $verifierId,
            'verified_at' => now(),
            'rejection_reason' => null,
        ]);
    }

    public function reject(int $verifierId, string $reason): void
    {
        $this->update([
            'status' => 'rejected',
            'verified_by' => $verifierId,
            'verified_at' => now(),
            'rejection_reason' => $reason,
        ]);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'Menunggu Verifikasi',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            default => $this->status,
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'yellow',
            'approved' => 'green',
            'rejected' => 'red',
            default => 'gray',
        };
    }
}
