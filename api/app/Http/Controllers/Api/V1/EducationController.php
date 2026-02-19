<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\EducationResource;
use App\Models\Education;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::orderBy('sort_order')
            ->orderByDesc('start_date')
            ->get();

        return EducationResource::collection($educations);
    }
}
