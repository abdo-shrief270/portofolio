<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExperienceResource;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        return ExperienceResource::collection(
            Experience::orderBy('sort_order')->orderByDesc('start_date')->paginate(20)
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'required|in:full_time,part_time,freelance,contract,internship',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
            'description' => 'nullable|string',
            'responsibilities' => 'nullable|array',
            'responsibilities.*' => 'string',
            'technologies_used' => 'nullable|array',
            'technologies_used.*' => 'string',
            'company_url' => 'nullable|url',
            'company_logo' => 'nullable|string',
            'sort_order' => 'integer',
        ]);

        $experience = Experience::create($validated);
        return new ExperienceResource($experience);
    }

    public function show($id)
    {
        return new ExperienceResource(Experience::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $experience = Experience::findOrFail($id);

        $validated = $request->validate([
            'company' => 'string|max:255',
            'position' => 'string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'in:full_time,part_time,freelance,contract,internship',
            'start_date' => 'date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_current' => 'boolean',
            'description' => 'nullable|string',
            'responsibilities' => 'nullable|array',
            'responsibilities.*' => 'string',
            'technologies_used' => 'nullable|array',
            'technologies_used.*' => 'string',
            'company_url' => 'nullable|url',
            'company_logo' => 'nullable|string',
            'sort_order' => 'integer',
        ]);

        $experience->update($validated);
        return new ExperienceResource($experience);
    }

    public function destroy($id)
    {
        Experience::findOrFail($id)->delete();
        return response()->json(['message' => 'Experience deleted']);
    }
}
