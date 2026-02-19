<?php
namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['category', 'technologies'])
            ->orderBy('sort_order')
            ->paginate(request()->get('per_page', 20));

        return ProjectResource::collection($projects);
    }

    public function store(StoreProjectRequest $request)
    {
        $project = Project::create($request->validated());

        if ($request->has('technology_ids')) {
            $project->technologies()->sync($request->technology_ids);
        }

        return new ProjectResource($project->load(['category', 'technologies']));
    }

    public function show($id)
    {
        $project = Project::with(['category', 'technologies', 'testimonials'])->findOrFail($id);
        return new ProjectResource($project);
    }

    public function update(UpdateProjectRequest $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($request->validated());

        if ($request->has('technology_ids')) {
            $project->technologies()->sync($request->technology_ids);
        }

        return new ProjectResource($project->load(['category', 'technologies']));
    }

    public function destroy($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json(['message' => 'Project not found or already deleted'], 200);
        }

        $project->delete();

        return response()->json(['message' => 'Project deleted']);
    }

    public function duplicate($id)
    {
        $project = Project::findOrFail($id);
        $newProject = $project->replicate();
        $newProject->title = $project->title . ' (Copy)';
        $newProject->slug = $project->slug . '-' . Str::random(5);
        $newProject->status = 'in_progress';
        $newProject->save();

        // Sync technologies
        $newProject->technologies()->sync($project->technologies->pluck('id'));

        return new ProjectResource($newProject);
    }

    public function provision($id)
    {
        $project = Project::findOrFail($id);
        
        // Placeholder for Module 5
        $project->update(['subdomain_status' => 'provisioning']);
        
        return response()->json([
            'message' => 'Provisioning started',
            'project' => new ProjectResource($project)
        ]);
    }

    public function start($id)
    {
        $project = Project::findOrFail($id);
        $project->update(['is_active' => true]);
        
        return response()->json([
            'message' => 'Project started',
            'project' => new ProjectResource($project)
        ]);
    }

    public function stop($id)
    {
        $project = Project::findOrFail($id);
        $project->update(['is_active' => false]);
        
        return response()->json([
            'message' => 'Project stopped',
            'project' => new ProjectResource($project)
        ]);
    }

    public function deprovision($id)
    {
        $project = Project::findOrFail($id);
        
        // Placeholder for Module 5
        $project->update(['subdomain_status' => 'deprovisioned']);
        
        return response()->json([
            'message' => 'Deprovisioned',
            'project' => new ProjectResource($project)
        ]);
    }

    public function credentials(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        // Generate temporary credentials (placeholder logic for Module 1 constraint)
        $credentials = [
            'admin' => [
                'email' => 'admin@' . ($project->slug ?? 'demo') . '.com',
                'password' => Str::random(10),
            ],
            'user' => [
                'email' => 'user@' . ($project->slug ?? 'demo') . '.com',
                'password' => Str::random(10),
            ],
            'expires_at' => now()->addDays(7)->toDateTimeString(),
        ];

        $project->update(['temp_credentials' => $credentials]);

        return response()->json([
            'message' => 'Credentials generated successfully',
            'credentials' => $credentials
        ]);
    }
}
