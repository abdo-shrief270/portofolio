<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'educations';

    protected $fillable = [
        'institution', 'degree', 'field_of_study',
        'start_date', 'end_date', 'is_current',
        'description', 'grade',
        'institution_url', 'institution_logo', 'sort_order',
    ];

    protected $casts = [
        'is_current' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}
