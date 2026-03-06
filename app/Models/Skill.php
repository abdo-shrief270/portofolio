<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Skill extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'category',
        'proficiency',
        'sort_order',
    ];

    public array $translatable = ['name'];

    protected $casts = [
        'proficiency' => 'integer',
    ];
}
