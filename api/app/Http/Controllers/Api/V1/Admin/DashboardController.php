<?php
namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ContactSubmission;
use App\Models\PageView;
use App\Models\Experience;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function stats()
    {
        $thirtyDaysAgo = now()->subDays(30);
        $sixtyDaysAgo  = now()->subDays(60);

        // Current period counts
        $totalProjects  = Project::count();
        $totalViews     = PageView::count();
        $totalContacts  = ContactSubmission::count();
        $recentViews    = PageView::where('created_at', '>=', $thirtyDaysAgo)->count();

        // Previous period counts (for trend calculation)
        $prevPeriodViews = PageView::whereBetween('created_at', [$sixtyDaysAgo, $thirtyDaysAgo])->count();
        $prevPeriodContacts = ContactSubmission::whereBetween('created_at', [$sixtyDaysAgo, $thirtyDaysAgo])->count();
        $recentContacts = ContactSubmission::where('created_at', '>=', $thirtyDaysAgo)->count();

        // Trends (percentage change)
        $viewsTrend    = $prevPeriodViews > 0 ? round((($recentViews - $prevPeriodViews) / $prevPeriodViews) * 100, 1) : 0;
        $contactsTrend = $prevPeriodContacts > 0 ? round((($recentContacts - $prevPeriodContacts) / $prevPeriodContacts) * 100, 1) : 0;

        // New contacts (unread)
        $newContacts = ContactSubmission::where('status', 'new')->count();

        return response()->json([
            'total_projects'   => $totalProjects,
            'total_views'      => $totalViews,
            'total_contacts'   => $totalContacts,
            'new_contacts'     => $newContacts,
            'recent_views'     => $recentViews,
            'views_trend'      => $viewsTrend,
            'contacts_trend'   => $contactsTrend,
            'active_projects'  => Project::where('status', 'live')->count(),
        ]);
    }

    public function viewsChart()
    {
        $days = request()->get('days', 30);
        $data = PageView::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as views')
            )
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json($data);
    }

    public function popularProjects()
    {
        $projects = Project::withCount('pageViews')
            ->orderBy('page_views_count', 'desc')
            ->limit(5)
            ->get()
            ->map(fn($p) => [
                'id'     => $p->id,
                'title'  => $p->title,
                'slug'   => $p->slug,
                'status' => $p->status,
                'views'  => $p->page_views_count,
            ]);

        return response()->json($projects);
    }

    public function recentContacts()
    {
        $contacts = ContactSubmission::orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(fn($c) => [
                'id'         => $c->id,
                'name'       => $c->name,
                'email'      => $c->email,
                'subject'    => $c->subject,
                'status'     => $c->status,
                'created_at' => $c->created_at->diffForHumans(),
            ]);

        return response()->json($contacts);
    }
}
