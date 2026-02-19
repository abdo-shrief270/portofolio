<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

class Technology extends Model
{
    /** @use HasFactory<\Database\Factories\TechnologyFactory> */
    use HasFactory, HasUlids, Searchable;

    protected $fillable = ['name', 'slug', 'icon', 'color', 'category', 'url'];

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class)->withPivot('is_primary');
    }
}
