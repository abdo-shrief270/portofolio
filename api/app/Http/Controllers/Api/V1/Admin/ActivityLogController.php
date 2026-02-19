<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 20);
        $model   = $request->get('model');

        $query = DB::table('activity_log')
            ->orderBy('created_at', 'desc');

        if ($model) {
            $query->where('subject_type', 'like', "%{$model}%");
        }

        // If the activity_log table doesn't exist (spatie/activitylog not installed),
        // fallback to a simple audit from model timestamps
        try {
            $activities = $query->paginate($perPage);

            return response()->json($activities);
        } catch (\Exception $e) {
            // Fallback: aggregate recent changes across all models
            return $this->fallbackActivityLog($perPage);
        }
    }

    private function fallbackActivityLog(int $perPage)
    {
        $models = [
            'Project'       => \App\Models\Project::class,
            'Category'      => \App\Models\Category::class,
            'Technology'    => \App\Models\Technology::class,
            'Testimonial'   => \App\Models\Testimonial::class,
            'Contact'       => \App\Models\ContactSubmission::class,
        ];

        $activities = collect();

        foreach ($models as $label => $modelClass) {
            $recent = $modelClass::orderBy('updated_at', 'desc')
                ->limit(10)
                ->get(['id', 'created_at', 'updated_at']);

            foreach ($recent as $item) {
                $action = $item->created_at->eq($item->updated_at) ? 'created' : 'updated';
                $activities->push([
                    'id'          => $item->id,
                    'description' => "{$action} {$label}",
                    'model'       => $label,
                    'action'      => $action,
                    'created_at'  => $item->updated_at->toIso8601String(),
                ]);
            }
        }

        $sorted = $activities->sortByDesc('created_at')->take($perPage)->values();

        return response()->json([
            'data'    => $sorted,
            'total'   => $sorted->count(),
            'current_page' => 1,
        ]);
    }
}
