<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = QueryBuilder::for(Project::class)
            ->where('is_active', true)
            ->allowedFilters([
                AllowedFilter::exact('category', 'category.slug'),
                AllowedFilter::partial('title'),
                'status',
            ])
            ->allowedSorts(['sort_order', 'created_at'])
            ->with(['category', 'technologies'])
            ->paginate(request()->get('per_page', 12));

        return ProjectResource::collection($projects);
    }

    public function featured()
    {
        $projects = Project::where('is_featured', true)
            ->where('is_active', true)
            ->with(['category', 'technologies'])
            ->orderBy('sort_order')
            ->get();

        return ProjectResource::collection($projects);
    }

    public function show(Project $project)
    {
        return new ProjectResource($project->load(['category', 'technologies', 'testimonials']));
    }

    public function track(Project $project, Request $request)
    {
        $project->pageViews()->create([
            'page' => 'project_detail',
            'ip_hash' => hash('sha256', $request->ip()),
            'referrer' => $request->header('referer'),
            'user_agent' => $request->userAgent(),
            'country' => $request->header('cf-ipcountry'), // Assuming Cloudflare or similar
        ]);

        return response()->json(['message' => 'View tracked']);
    }
}
