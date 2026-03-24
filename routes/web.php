<?php

use App\Http\Controllers\PageController;
use App\Models\BlogPost;
use App\Models\Project;
use Illuminate\Support\Facades\Route;

// Public Pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/projects', [PageController::class, 'projects'])->name('projects.index');
Route::get('/projects/{slug}', [PageController::class, 'projectShow'])->name('projects.show');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/blog', [PageController::class, 'blog'])->name('blog.index');
Route::get('/blog/{slug}', [PageController::class, 'blogShow'])->name('blog.show');
Route::get('/quote', [PageController::class, 'quote'])->name('quote');

// Sitemap (generates static file)
Route::get('/generate-sitemap', function () {
    $urls = collect();

    // Static pages
    $urls->push(['loc' => url('/'), 'priority' => '1.0', 'changefreq' => 'weekly']);
    $urls->push(['loc' => route('about'), 'priority' => '0.8', 'changefreq' => 'monthly']);
    $urls->push(['loc' => route('projects.index'), 'priority' => '0.8', 'changefreq' => 'weekly']);
    $urls->push(['loc' => route('services'), 'priority' => '0.7', 'changefreq' => 'monthly']);
    $urls->push(['loc' => route('blog.index'), 'priority' => '0.8', 'changefreq' => 'daily']);
    $urls->push(['loc' => route('quote'), 'priority' => '0.6', 'changefreq' => 'monthly']);

    // Published projects
    Project::published()->orderBy('updated_at', 'desc')->get()->each(function ($project) use ($urls) {
        $urls->push([
            'loc' => route('projects.show', $project->slug),
            'lastmod' => $project->updated_at->toW3cString(),
            'priority' => '0.7',
            'changefreq' => 'monthly',
        ]);
    });

    // Published blog posts
    BlogPost::published()->orderBy('published_at', 'desc')->get()->each(function ($post) use ($urls) {
        $urls->push([
            'loc' => route('blog.show', $post->slug),
            'lastmod' => $post->updated_at->toW3cString(),
            'priority' => '0.7',
            'changefreq' => 'monthly',
        ]);
    });

    $content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    foreach ($urls as $url) {
        $content .= "  <url>\n";
        $content .= "    <loc>{$url['loc']}</loc>\n";
        if (isset($url['lastmod'])) {
            $content .= "    <lastmod>{$url['lastmod']}</lastmod>\n";
        }
        $content .= "    <changefreq>{$url['changefreq']}</changefreq>\n";
        $content .= "    <priority>{$url['priority']}</priority>\n";
        $content .= "  </url>\n";
    }

    $content .= '</urlset>';

    // Write static file to public/
    file_put_contents(public_path('sitemap.xml'), $content);

    return response($content, 200, ['Content-Type' => 'application/xml']);
})->name('generate-sitemap');
