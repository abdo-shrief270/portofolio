<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\TechStack;
use App\Models\Testimonial;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        $featuredProjects = Project::query()
            ->published()
            ->featured()
            ->with(['techStacks', 'media'])
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $services = Service::query()
            ->active()
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $testimonials = Testimonial::query()
            ->published()
            ->featured()
            ->with('media')
            ->orderBy('sort_order')
            ->take(6)
            ->get();

        $techStacks = TechStack::query()
            ->featured()
            ->orderBy('sort_order')
            ->take(8)
            ->get();

        return view('pages.home', compact('featuredProjects', 'services', 'testimonials', 'techStacks'));
    }

    public function about(): View
    {
        $skills = Skill::query()
            ->orderBy('category')
            ->orderBy('sort_order')
            ->get()
            ->groupBy('category');

        return view('pages.about', compact('skills'));
    }

    public function projects(): View
    {
        return view('pages.projects.index');
    }

    public function projectShow(string $slug): View
    {
        $project = Project::query()
            ->published()
            ->where('slug', $slug)
            ->with(['techStacks', 'features', 'media'])
            ->firstOrFail();

        $relatedProjects = Project::query()
            ->published()
            ->where('id', '!=', $project->id)
            ->whereHas('techStacks', function ($query) use ($project) {
                $query->whereIn('tech_stacks.id', $project->techStacks->pluck('id'));
            })
            ->with(['techStacks', 'media'])
            ->take(3)
            ->get();

        return view('pages.projects.show', compact('project', 'relatedProjects'));
    }

    public function services(): View
    {
        $services = Service::query()
            ->active()
            ->with('media')
            ->orderBy('sort_order')
            ->get();

        $techStacks = TechStack::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('pages.services', compact('services', 'techStacks'));
    }

    public function blog(): View
    {
        $posts = BlogPost::query()
            ->published()
            ->with(['category', 'media'])
            ->orderByDesc('published_at')
            ->paginate(9);

        return view('pages.blog.index', compact('posts'));
    }

    public function blogShow(string $slug): View
    {
        $post = BlogPost::query()
            ->published()
            ->where('slug', $slug)
            ->with(['category', 'media'])
            ->firstOrFail();

        $relatedPosts = BlogPost::query()
            ->published()
            ->where('id', '!=', $post->id)
            ->where('blog_category_id', $post->blog_category_id)
            ->with('media')
            ->take(3)
            ->get();

        return view('pages.blog.show', compact('post', 'relatedPosts'));
    }

    public function quote(): View
    {
        return view('pages.quote');
    }
}
