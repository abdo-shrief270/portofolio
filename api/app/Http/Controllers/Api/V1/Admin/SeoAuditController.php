<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;

class SeoAuditController extends Controller
{
    public function index()
    {
        $projects = Project::with('category')
            ->orderBy('title')
            ->get();

        $audit = $projects->map(function ($project) {
            $seo = $project->seo ?? [];

            $checks = [
                'has_title'           => !empty($seo['title'] ?? $project->title),
                'has_description'     => !empty($seo['description'] ?? $project->short_description),
                'has_keywords'        => !empty($seo['keywords'] ?? null) && count($seo['keywords'] ?? []) > 0,
                'has_og_image'        => !empty($seo['og_image'] ?? $project->thumbnail),
                'has_thumbnail'       => !empty($project->thumbnail),
                'has_short_description' => !empty($project->short_description),
                'has_category'        => !empty($project->category_id),
                'has_demo_url'        => !empty($project->demo_url),
            ];

            $score = count(array_filter($checks));
            $total = count($checks);

            return [
                'id'       => $project->id,
                'title'    => $project->title,
                'slug'     => $project->slug,
                'status'   => $project->status,
                'checks'   => $checks,
                'score'    => $score,
                'total'    => $total,
                'percentage' => round(($score / $total) * 100),
            ];
        });

        return response()->json([
            'data' => $audit,
            'summary' => [
                'total_projects' => $projects->count(),
                'average_score'  => round($audit->avg('percentage')),
                'perfect_count'  => $audit->where('percentage', 100)->count(),
            ],
        ]);
    }
}
