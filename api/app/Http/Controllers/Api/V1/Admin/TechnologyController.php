<?php
namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\TechnologyResource;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    public function index()
    {
        return TechnologyResource::collection(Technology::orderBy('name')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:technologies,slug',
            'icon' => 'required|string',
            'color' => 'nullable|string',
            'category' => 'required|in:frontend,backend,database,devops,other',
            'url' => 'nullable|url',
        ]);

        $technology = Technology::create($validated);
        return new TechnologyResource($technology);
    }

    public function show($id)
    {
        return new TechnologyResource(Technology::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $technology = Technology::findOrFail($id);
        $validated = $request->validate([
            'name' => 'string|max:255',
            'slug' => 'string|unique:technologies,slug,' . $id,
            'icon' => 'string',
            'color' => 'nullable|string',
            'category' => 'in:frontend,backend,database,devops,other',
            'url' => 'nullable|url',
        ]);

        $technology->update($validated);
        return new TechnologyResource($technology);
    }

    public function destroy($id)
    {
        $technology = Technology::findOrFail($id);
        $technology->delete();
        return response()->json(['message' => 'Technology deleted']);
    }
}
