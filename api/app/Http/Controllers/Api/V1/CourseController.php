<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('sort_order')
            ->orderByDesc('completed_at')
            ->get();

        return CourseResource::collection($courses);
    }
}
