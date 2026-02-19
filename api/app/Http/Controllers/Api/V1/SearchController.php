<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CourseResource;
use App\Models\Project;
use App\Models\Category;
use App\Models\Technology;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q', '');

        if (strlen($query) < 2) {
            return response()->json([
                'projects' => [],
                'categories' => [],
                'technologies' => [],
            ]);
        }

        // Use Scout search (Meilisearch) for full-text search
        $projects = Project::search($query)
            ->query(fn ($q) => $q->with(['category', 'technologies']))
            ->get()
            ->take(10);

        $categories = Category::search($query)->get()->take(5);

        $technologies = Technology::search($query)->get()->take(5);

        return response()->json([
            'projects' => ProjectResource::collection($projects),
            'categories' => CategoryResource::collection($categories),
            'technologies' => $technologies->map(fn ($t) => [
                'id' => $t->id,
                'name' => $t->name,
                'slug' => $t->slug,
                'icon' => $t->icon,
            ]),
        ]);
    }
}
