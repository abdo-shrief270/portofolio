<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TechStack extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'color',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_tech_stack');
    }
}
