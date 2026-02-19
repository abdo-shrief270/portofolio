<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'title', 'provider', 'instructor',
        'description', 'certificate_url', 'course_url',
        'completed_at', 'duration_hours',
        'skills_learned', 'thumbnail', 'sort_order',
    ];

    protected $casts = [
        'skills_learned' => 'array',
        'completed_at' => 'date',
    ];
}
