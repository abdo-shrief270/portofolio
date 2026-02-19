<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'company', 'position', 'location', 'type',
        'start_date', 'end_date', 'is_current',
        'description', 'responsibilities', 'technologies_used',
        'company_url', 'company_logo', 'sort_order',
    ];

    protected $casts = [
        'responsibilities' => 'array',
        'technologies_used' => 'array',
        'is_current' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}
