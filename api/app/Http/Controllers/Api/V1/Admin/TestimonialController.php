<?php
namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestimonialResource;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        return TestimonialResource::collection(Testimonial::with('project')->latest()->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'nullable|exists:projects,id',
            'client_name' => 'required|string|max:255',
            'client_role' => 'nullable|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'client_avatar' => 'nullable|string',
            'content' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'is_featured' => 'boolean',
        ]);

        $testimonial = Testimonial::create($validated);
        return new TestimonialResource($testimonial);
    }

    public function show($id)
    {
        return new TestimonialResource(Testimonial::with('project')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $validated = $request->validate([
            'project_id' => 'nullable|exists:projects,id',
            'client_name' => 'string|max:255',
            'client_role' => 'nullable|string|max:255',
            'client_company' => 'nullable|string|max:255',
            'client_avatar' => 'nullable|string',
            'content' => 'string',
            'rating' => 'nullable|integer|min:1|max:5',
            'is_featured' => 'boolean',
        ]);

        $testimonial->update($validated);
        return new TestimonialResource($testimonial);
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();
        return response()->json(['message' => 'Testimonial deleted']);
    }
}
