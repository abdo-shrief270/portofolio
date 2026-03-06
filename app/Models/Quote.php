<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'project_type',
        'budget_range',
        'message',
        'status',
        'notes',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }
}
