<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\EducationResource;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        return EducationResource::collection(
            Education::orderBy('sort_order')->orderByDesc('start_date')->paginate(20)
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
            'description' => 'nullable|string',
            'grade' => 'nullable|string|max:100',
            'institution_url' => 'nullable|url',
            'institution_logo' => 'nullable|string',
            'sort_order' => 'integer',
        ]);

        $education = Education::create($validated);
        return new EducationResource($education);
    }

    public function show($id)
    {
        return new EducationResource(Education::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $education = Education::findOrFail($id);

        $validated = $request->validate([
            'institution' => 'string|max:255',
            'degree' => 'string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            'start_date' => 'date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
            'description' => 'nullable|string',
            'grade' => 'nullable|string|max:100',
            'institution_url' => 'nullable|url',
            'institution_logo' => 'nullable|string',
            'sort_order' => 'integer',
        ]);

        $education->update($validated);
        return new EducationResource($education);
    }

    public function destroy($id)
    {
        Education::findOrFail($id)->delete();
        return response()->json(['message' => 'Education deleted']);
    }
}
