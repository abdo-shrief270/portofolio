<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ContactSubmission;
use App\Models\Course;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public function run(): void
    {
        // Disable Scout search syncing during seeding so Meilisearch doesn't need to be running
        Category::withoutSyncingToSearch(fn () =>
        Technology::withoutSyncingToSearch(fn () =>
        Project::withoutSyncingToSearch(fn () =>
            $this->seed()
        )));
    }

    private function seed(): void
    {
        // ── Admin User ──────────────────────────────────────────
        User::firstOrCreate(
            ['email' => 'admin@portfolio.test'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
            ]
        );

        // ── Categories ──────────────────────────────────────────
        $categories = [
            ['name' => 'Web Application', 'slug' => 'web-application', 'description' => 'Full-stack web applications', 'icon' => 'globe', 'sort_order' => 1],
            ['name' => 'Mobile App', 'slug' => 'mobile-app', 'description' => 'iOS and Android applications', 'icon' => 'smartphone', 'sort_order' => 2],
            ['name' => 'API / Backend', 'slug' => 'api-backend', 'description' => 'RESTful APIs and backend services', 'icon' => 'server', 'sort_order' => 3],
            ['name' => 'DevOps / Infrastructure', 'slug' => 'devops-infrastructure', 'description' => 'CI/CD pipelines and cloud infrastructure', 'icon' => 'cloud', 'sort_order' => 4],
            ['name' => 'Open Source', 'slug' => 'open-source', 'description' => 'Open-source contributions and packages', 'icon' => 'github', 'sort_order' => 5],
        ];

        $catModels = [];
        foreach ($categories as $cat) {
            $catModels[$cat['slug']] = Category::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        // ── Technologies ────────────────────────────────────────
        $techs = [
            ['name' => 'Laravel', 'slug' => 'laravel', 'icon' => 'laravel', 'color' => '#FF2D20', 'category' => 'Backend'],
            ['name' => 'PHP', 'slug' => 'php', 'icon' => 'php', 'color' => '#777BB4', 'category' => 'Backend'],
            ['name' => 'Next.js', 'slug' => 'nextjs', 'icon' => 'nextjs', 'color' => '#000000', 'category' => 'Frontend'],
            ['name' => 'React', 'slug' => 'react', 'icon' => 'react', 'color' => '#61DAFB', 'category' => 'Frontend'],
            ['name' => 'TypeScript', 'slug' => 'typescript', 'icon' => 'typescript', 'color' => '#3178C6', 'category' => 'Frontend'],
            ['name' => 'Tailwind CSS', 'slug' => 'tailwindcss', 'icon' => 'tailwindcss', 'color' => '#06B6D4', 'category' => 'Frontend'],
            ['name' => 'MySQL', 'slug' => 'mysql', 'icon' => 'mysql', 'color' => '#4479A1', 'category' => 'Database'],
            ['name' => 'Redis', 'slug' => 'redis', 'icon' => 'redis', 'color' => '#DC382D', 'category' => 'Database'],
            ['name' => 'Docker', 'slug' => 'docker', 'icon' => 'docker', 'color' => '#2496ED', 'category' => 'DevOps'],
            ['name' => 'Nginx', 'slug' => 'nginx', 'icon' => 'nginx', 'color' => '#009639', 'category' => 'DevOps'],
            ['name' => 'Vue.js', 'slug' => 'vuejs', 'icon' => 'vuejs', 'color' => '#4FC08D', 'category' => 'Frontend'],
            ['name' => 'Node.js', 'slug' => 'nodejs', 'icon' => 'nodejs', 'color' => '#339933', 'category' => 'Backend'],
        ];

        $techModels = [];
        foreach ($techs as $t) {
            $techModels[$t['slug']] = Technology::firstOrCreate(['slug' => $t['slug']], $t);
        }

        // ── Projects ────────────────────────────────────────────
        $projects = [
            [
                'title' => 'DevPortfolio Platform',
                'slug' => 'devportfolio-platform',
                'subtitle' => 'Next-generation developer portfolio with live previews',
                'description' => "Full-stack portfolio platform built with Laravel 12 and Next.js 16.\n\n- Dashboard for managing projects, categories, and technologies\n- Public portfolio with glassmorphism design\n- Subdomain-based project previews\n- Browser-based terminal for server management",
                'short_description' => 'Full-stack developer portfolio with live previews and browser terminal.',
                'category_slug' => 'web-application',
                'status' => 'live',
                'is_featured' => true,
                'is_active' => true,
                'demo_url' => 'https://portfolio.test',
                'github_url' => 'https://github.com/user/devportfolio',
                'tech_stack' => ['Laravel 12', 'Next.js 16', 'Tailwind CSS 4', 'MySQL 8', 'Redis'],
                'features' => [
                    ['title' => 'Live Previews', 'description' => 'Auto-provisioned subdomains'],
                    ['title' => 'Browser Terminal', 'description' => 'WebSocket-based SSH terminal'],
                    ['title' => 'Smart Search', 'description' => 'Full-text search via Meilisearch'],
                ],
                'seo_title' => 'DevPortfolio - Developer Portfolio Platform',
                'seo_description' => 'Modern developer portfolio with live project previews.',
                'techs' => ['laravel', 'nextjs', 'typescript', 'tailwindcss', 'mysql', 'redis'],
            ],
            [
                'title' => 'E-Commerce API',
                'slug' => 'ecommerce-api',
                'subtitle' => 'Scalable REST API for multi-vendor marketplace',
                'description' => "High-performance REST API with multi-vendor support and Stripe payments.\n\n- Event-driven architecture with Redis queues\n- 95% test coverage\n- OpenAPI documentation",
                'short_description' => 'Multi-vendor e-commerce API with Stripe and real-time inventory.',
                'category_slug' => 'api-backend',
                'status' => 'completed',
                'is_featured' => true,
                'is_active' => true,
                'github_url' => 'https://github.com/user/ecommerce-api',
                'tech_stack' => ['Laravel 11', 'PHP 8.3', 'MySQL 8', 'Redis'],
                'features' => [
                    ['title' => 'Multi-Vendor', 'description' => 'Independent seller storefronts'],
                    ['title' => 'Real-time Inventory', 'description' => 'Event-driven stock management'],
                ],
                'techs' => ['laravel', 'php', 'mysql', 'redis'],
            ],
            [
                'title' => 'Task Flow',
                'slug' => 'task-flow',
                'subtitle' => 'AI-powered project management dashboard',
                'description' => 'Modern project management with AI-assisted task prioritization and Kanban boards.',
                'short_description' => 'AI-powered Kanban with real-time collaboration.',
                'category_slug' => 'web-application',
                'status' => 'in_progress',
                'is_featured' => false,
                'is_active' => true,
                'tech_stack' => ['React 19', 'Node.js', 'TypeScript', 'PostgreSQL'],
                'features' => [
                    ['title' => 'AI Prioritization', 'description' => 'Smart sprint recommendations'],
                    ['title' => 'Real-time Boards', 'description' => 'Live Kanban across teams'],
                ],
                'techs' => ['react', 'nodejs', 'typescript'],
            ],
            [
                'title' => 'CloudDeploy CLI',
                'slug' => 'clouddeploy-cli',
                'subtitle' => 'Zero-config deployment for Laravel apps',
                'description' => "CLI tool for zero-downtime Laravel deployments to any VPS.\n\nSupported: DigitalOcean, Hetzner, AWS EC2, Custom VPS.",
                'short_description' => 'Zero-config, zero-downtime Laravel deployments.',
                'category_slug' => 'open-source',
                'status' => 'live',
                'is_featured' => true,
                'is_active' => true,
                'github_url' => 'https://github.com/user/clouddeploy',
                'tech_stack' => ['PHP 8.4', 'Laravel Zero', 'Docker', 'Nginx'],
                'features' => [
                    ['title' => 'Zero Downtime', 'description' => 'Atomic deployments with rollback'],
                    ['title' => 'Multi-Provider', 'description' => 'Works on any VPS'],
                ],
                'techs' => ['php', 'laravel', 'docker', 'nginx'],
            ],
            [
                'title' => 'Learning Hub',
                'slug' => 'learning-hub',
                'subtitle' => 'Online course platform with progress tracking',
                'description' => 'Full-featured LMS with video courses, quizzes, certificates, and a Filament admin panel.',
                'short_description' => 'LMS with video courses, quizzes, and auto-certificates.',
                'category_slug' => 'web-application',
                'status' => 'completed',
                'is_featured' => false,
                'is_active' => true,
                'tech_stack' => ['Laravel 11', 'Vue.js 3', 'Filament', 'MySQL'],
                'features' => [
                    ['title' => 'Video Streaming', 'description' => 'Adaptive bitrate with HLS'],
                    ['title' => 'Certifications', 'description' => 'Auto PDF certificates'],
                ],
                'techs' => ['laravel', 'vuejs', 'mysql'],
            ],
            [
                'title' => 'IoT Dashboard',
                'slug' => 'iot-dashboard',
                'subtitle' => 'Real-time monitoring for smart home devices',
                'description' => 'Responsive dashboard for monitoring and controlling IoT devices with real-time charts and automation rules.',
                'short_description' => 'Real-time IoT monitoring with device control.',
                'category_slug' => 'web-application',
                'status' => 'live',
                'is_featured' => false,
                'is_active' => true,
                'tech_stack' => ['Next.js 15', 'React', 'Firebase', 'Tailwind CSS'],
                'features' => [
                    ['title' => 'Live Monitoring', 'description' => 'Real-time sensor data'],
                    ['title' => 'Automation', 'description' => 'Rule-based device control'],
                ],
                'techs' => ['nextjs', 'react', 'tailwindcss'],
            ],
        ];

        foreach ($projects as $p) {
            $techSlugs = $p['techs'] ?? [];
            $catSlug = $p['category_slug'];
            unset($p['techs'], $p['category_slug']);

            $p['category_id'] = $catModels[$catSlug]->id;
            $p['sort_order'] = 0;

            $project = Project::firstOrCreate(['slug' => $p['slug']], $p);

            $ids = collect($techSlugs)
                ->filter(fn ($s) => isset($techModels[$s]))
                ->map(fn ($s) => $techModels[$s]->id)
                ->values()->toArray();
            $project->technologies()->syncWithoutDetaching($ids);
        }

        // ── Work Experience ─────────────────────────────────────
        $experiences = [
            [
                'company' => 'TechCorp Solutions',
                'position' => 'Senior Full-Stack Developer',
                'location' => 'Remote',
                'type' => 'full_time',
                'start_date' => '2023-06-01',
                'is_current' => true,
                'description' => 'Leading SaaS product development with Laravel and React.',
                'responsibilities' => ['Architect scalable apps', 'Lead code reviews', 'Mentor junior devs'],
                'technologies_used' => ['Laravel', 'React', 'TypeScript', 'AWS', 'Docker'],
                'sort_order' => 1,
            ],
            [
                'company' => 'Digital Agency Pro',
                'position' => 'Full-Stack Developer',
                'location' => 'Cairo, Egypt',
                'type' => 'full_time',
                'start_date' => '2021-03-01',
                'end_date' => '2023-05-31',
                'is_current' => false,
                'description' => 'Delivered 15+ client web applications using Laravel and Vue.js.',
                'responsibilities' => ['Build client apps', 'Integrate APIs', 'Optimize performance'],
                'technologies_used' => ['Laravel', 'Vue.js', 'MySQL', 'Redis'],
                'sort_order' => 2,
            ],
            [
                'company' => 'StartupHub',
                'position' => 'Backend Developer',
                'location' => 'Cairo, Egypt',
                'type' => 'internship',
                'start_date' => '2020-06-01',
                'end_date' => '2021-02-28',
                'is_current' => false,
                'description' => 'Built RESTful APIs for mobile applications with Laravel.',
                'responsibilities' => ['Develop REST endpoints', 'Write PHPUnit tests'],
                'technologies_used' => ['Laravel', 'PHP', 'MySQL'],
                'sort_order' => 3,
            ],
        ];

        foreach ($experiences as $exp) {
            Experience::firstOrCreate(
                ['company' => $exp['company'], 'position' => $exp['position']],
                $exp
            );
        }

        // ── Education ───────────────────────────────────────────
        Education::firstOrCreate(
            ['institution' => 'Cairo University', 'degree' => 'Bachelor of Science'],
            [
                'institution' => 'Cairo University',
                'degree' => 'Bachelor of Science',
                'field_of_study' => 'Computer Science',
                'start_date' => '2017-09-01',
                'end_date' => '2021-06-30',
                'is_current' => false,
                'description' => 'Focused on SE, algorithms, and web technologies.',
                'grade' => 'Very Good',
                'sort_order' => 1,
            ]
        );

        // ── Courses & Certifications ────────────────────────────
        $courses = [
            [
                'title' => 'Advanced Laravel Development',
                'provider' => 'Laracasts',
                'instructor' => 'Jeffrey Way',
                'description' => 'Deep dive into Laravel internals and advanced patterns.',
                'course_url' => 'https://laracasts.com',
                'completed_at' => '2023-08-15',
                'duration_hours' => 40,
                'skills_learned' => ['Service Providers', 'Artisan Commands', 'Queue Workers'],
                'sort_order' => 1,
            ],
            [
                'title' => 'React - The Complete Guide',
                'provider' => 'Udemy',
                'instructor' => 'Maximilian Schwarzmüller',
                'description' => 'Comprehensive React with hooks, context, and Redux.',
                'course_url' => 'https://udemy.com',
                'completed_at' => '2023-03-10',
                'duration_hours' => 48,
                'skills_learned' => ['React Hooks', 'Context API', 'Redux', 'Next.js'],
                'sort_order' => 2,
            ],
            [
                'title' => 'AWS Solutions Architect Associate',
                'provider' => 'AWS',
                'description' => 'Cloud architecture, HA, cost optimization, and security.',
                'certificate_url' => 'https://aws.amazon.com/certification',
                'completed_at' => '2024-01-20',
                'duration_hours' => 60,
                'skills_learned' => ['EC2', 'S3', 'RDS', 'Lambda', 'VPC'],
                'sort_order' => 3,
            ],
            [
                'title' => 'Docker & Kubernetes Masterclass',
                'provider' => 'Pluralsight',
                'instructor' => 'Nigel Poulton',
                'description' => 'Container orchestration and production deployment.',
                'course_url' => 'https://pluralsight.com',
                'completed_at' => '2024-06-05',
                'duration_hours' => 35,
                'skills_learned' => ['Docker Compose', 'Kubernetes', 'Helm', 'CI/CD'],
                'sort_order' => 4,
            ],
        ];

        foreach ($courses as $c) {
            Course::firstOrCreate(
                ['title' => $c['title'], 'provider' => $c['provider']],
                $c
            );
        }
    }
}
