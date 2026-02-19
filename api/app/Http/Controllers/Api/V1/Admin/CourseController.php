<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return CourseResource::collection(
            Course::orderBy('sort_order')->orderByDesc('completed_at')->paginate(20)
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'provider' => 'required|string|max:255',
            'instructor' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'certificate_url' => 'nullable|url',
            'course_url' => 'nullable|url',
            'completed_at' => 'nullable|date',
            'duration_hours' => 'nullable|integer|min:0',
            'skills_learned' => 'nullable|array',
            'skills_learned.*' => 'string',
            'thumbnail' => 'nullable|string',
            'sort_order' => 'integer',
        ]);

        $course = Course::create($validated);
        return new CourseResource($course);
    }

    public function show($id)
    {
        return new CourseResource(Course::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $validated = $request->validate([
            'title' => 'string|max:255',
            'provider' => 'string|max:255',
            'instructor' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'certificate_url' => 'nullable|url',
            'course_url' => 'nullable|url',
            'completed_at' => 'nullable|date',
            'duration_hours' => 'nullable|integer|min:0',
            'skills_learned' => 'nullable|array',
            'skills_learned.*' => 'string',
            'thumbnail' => 'nullable|string',
            'sort_order' => 'integer',
        ]);

        $course->update($validated);
        return new CourseResource($course);
    }

    public function destroy($id)
    {
        Course::findOrFail($id)->delete();
        return response()->json(['message' => 'Course deleted']);
    }
}
