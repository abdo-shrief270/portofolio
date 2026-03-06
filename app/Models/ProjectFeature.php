<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class ProjectFeature extends Model
{
    use HasTranslations;

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'icon',
        'sort_order',
    ];

    public array $translatable = ['title', 'description'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
