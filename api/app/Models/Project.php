<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory, HasUlids, Searchable, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'subtitle', 'description', 'short_description',
        'category_id', 'status', 'is_featured', 'is_active', 'demo_url', 'subdomain',
        'subdomain_status', 'github_url', 'thumbnail', 'gallery',
        'tech_stack', 'features', 'temp_credentials', 'seo_title',
        'seo_description', 'seo_keywords', 'og_image', 'sort_order',
        'published_at'
    ];

    protected $casts = [
        'gallery' => 'array',
        'tech_stack' => 'array',
        'features' => 'array',
        'seo_keywords' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'temp_credentials' => 'encrypted:array',
        'published_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class)->withPivot('is_primary');
    }

    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class);
    }

    public function contactSubmissions(): HasMany
    {
        return $this->hasMany(ContactSubmission::class);
    }

    public function pageViews(): HasMany
    {
        return $this->hasMany(PageView::class);
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'subtitle' => $this->subtitle,
            'description' => $this->description,
            'short_description' => $this->short_description,
            'status' => $this->status,
        ];
    }
}
