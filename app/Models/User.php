<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'nip',
        'email',
        'password',
        'role',
        'is_active',
        'phone',
        'profile_photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Tentukan siapa yang bisa akses panel Filament (hanya TU)
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === 'tu' && $this->is_active;
    }

    // ============================================
    // RELATIONSHIPS
    // ============================================

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function activityReports(): HasMany
    {
        return $this->hasMany(ActivityReport::class);
    }

    public function performanceReviews(): HasMany
    {
        return $this->hasMany(PerformanceReview::class);
    }

    public function givenReviews(): HasMany
    {
        return $this->hasMany(PerformanceReview::class, 'reviewer_id');
    }

    public function verifiedReports(): HasMany
    {
        return $this->hasMany(ActivityReport::class, 'verified_by');
    }

    // ============================================
    // HELPER METHODS
    // ============================================

    public function isPamong(): bool
    {
        return $this->role === 'pamong';
    }

    public function isTU(): bool
    {
        return $this->role === 'tu';
    }

    public function isKepalaSKB(): bool
    {
        return $this->role === 'kepala_skb';
    }

    public function getRoleLabelAttribute(): string
    {
        return match ($this->role) {
            'pamong' => 'Pamong',
            'tu' => 'Tata Usaha',
            'kepala_skb' => 'Kepala SKB',
            default => $this->role,
        };
    }

    /**
     * URL foto profil atau default avatar dengan inisial
     */
    public function getProfilePhotoUrlAttribute(): ?string
    {
        if ($this->profile_photo) {
            return asset('storage/' . $this->profile_photo);
        }

        return null;
    }

    /**
     * Inisial nama user (untuk default avatar)
     */
    public function getInitialsAttribute(): string
    {
        $words = explode(' ', $this->name);
        $initials = '';
        foreach (array_slice($words, 0, 2) as $word) {
            $initials .= mb_strtoupper(mb_substr($word, 0, 1));
        }
        return $initials;
    }
}
