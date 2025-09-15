<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class JobPosting extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id', 'title', 'description', 'requirements', 'location',
        'employment_type', 'salary', 'status', 'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    /**
     * Get a short excerpt of the description for listing pages.
     */
    public function getExcerptAttribute(): string
    {
        $raw_description = (string) ($this->description ?? '');
        $normalized_description = preg_replace("/\r\n|\r|\n/", ' ', $raw_description) ?? '';
        $collapsed_whitespace = preg_replace('/\s+/', ' ', $normalized_description) ?? '';
        return Str::limit(trim($collapsed_whitespace), 180);
    }
}
