<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageView extends Model
{
    /** @use HasFactory<\Database\Factories\PageViewFactory> */
    use HasFactory;

    protected $fillable = [
        'page', 'project_id', 'ip_hash', 'referrer', 'user_agent', 'country'
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
