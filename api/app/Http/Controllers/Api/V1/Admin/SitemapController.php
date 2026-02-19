<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;

class SitemapController extends Controller
{
    public function generate()
    {
        try {
            // If spatie/laravel-sitemap is installed
            if (class_exists(\Spatie\Sitemap\SitemapGenerator::class)) {
                \Spatie\Sitemap\SitemapGenerator::create(config('app.frontend_url', config('app.url')))
                    ->writeToFile(public_path('sitemap.xml'));

                return response()->json([
                    'message' => 'Sitemap generated successfully.',
                ]);
            }

            // Fallback: generate a basic sitemap from projects
            $projects = \App\Models\Project::where('status', '!=', 'archived')
                ->whereNotNull('published_at')
                ->get();

            $frontendUrl = config('app.frontend_url', 'https://portfolio.dev');

            $xml  = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
            $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

            // Static pages
            $staticPages = ['', '/projects', '/about', '/contact'];
            foreach ($staticPages as $page) {
                $xml .= '  <url>' . PHP_EOL;
                $xml .= '    <loc>' . $frontendUrl . $page . '</loc>' . PHP_EOL;
                $xml .= '    <changefreq>weekly</changefreq>' . PHP_EOL;
                $xml .= '    <priority>' . ($page === '' ? '1.0' : '0.8') . '</priority>' . PHP_EOL;
                $xml .= '  </url>' . PHP_EOL;
            }

            // Project pages
            foreach ($projects as $project) {
                $xml .= '  <url>' . PHP_EOL;
                $xml .= '    <loc>' . $frontendUrl . '/projects/' . $project->slug . '</loc>' . PHP_EOL;
                $xml .= '    <lastmod>' . $project->updated_at->toW3cString() . '</lastmod>' . PHP_EOL;
                $xml .= '    <changefreq>monthly</changefreq>' . PHP_EOL;
                $xml .= '    <priority>0.7</priority>' . PHP_EOL;
                $xml .= '  </url>' . PHP_EOL;
            }

            $xml .= '</urlset>';

            file_put_contents(public_path('sitemap.xml'), $xml);

            return response()->json([
                'message' => 'Sitemap generated successfully.',
                'url_count' => count($staticPages) + $projects->count(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Sitemap generation failed: ' . $e->getMessage(),
            ], 500);
        }
    }
}
