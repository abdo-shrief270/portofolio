<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class BlogCategory extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'slug',
        'sort_order',
    ];

    public array $translatable = ['name'];

    public function posts(): HasMany
    {
        return $this->hasMany(BlogPost::class);
    }
}
