<?php

namespace Database\Seeders;

use App\Models\TechStack;
use Illuminate\Database\Seeder;

class TechStackSeeder extends Seeder
{
    public function run(): void
    {
        $techStacks = [
            // Backend
            [
                'name' => 'Laravel',
                'slug' => 'laravel',
                'icon' => 'heroicon-o-cube',
                'color' => '#FF2D20',
                'is_featured' => true,
            ],
            [
                'name' => 'PHP',
                'slug' => 'php',
                'icon' => 'heroicon-o-code-bracket',
                'color' => '#777BB4',
                'is_featured' => true,
            ],
            [
                'name' => 'Node.js',
                'slug' => 'nodejs',
                'icon' => 'heroicon-o-server',
                'color' => '#339933',
                'is_featured' => true,
            ],
            [
                'name' => 'Python',
                'slug' => 'python',
                'icon' => 'heroicon-o-command-line',
                'color' => '#3776AB',
            ],
            [
                'name' => 'Express.js',
                'slug' => 'expressjs',
                'icon' => 'heroicon-o-server-stack',
                'color' => '#000000',
            ],
            [
                'name' => 'NestJS',
                'slug' => 'nestjs',
                'icon' => 'heroicon-o-cube-transparent',
                'color' => '#E0234E',
            ],

            // Databases
            [
                'name' => 'MySQL',
                'slug' => 'mysql',
                'icon' => 'heroicon-o-circle-stack',
                'color' => '#4479A1',
                'is_featured' => true,
            ],
            [
                'name' => 'PostgreSQL',
                'slug' => 'postgresql',
                'icon' => 'heroicon-o-circle-stack',
                'color' => '#336791',
            ],
            [
                'name' => 'MongoDB',
                'slug' => 'mongodb',
                'icon' => 'heroicon-o-circle-stack',
                'color' => '#47A248',
            ],
            [
                'name' => 'Redis',
                'slug' => 'redis',
                'icon' => 'heroicon-o-bolt',
                'color' => '#DC382D',
            ],
            [
                'name' => 'Elasticsearch',
                'slug' => 'elasticsearch',
                'icon' => 'heroicon-o-magnifying-glass',
                'color' => '#005571',
            ],

            // Frontend
            [
                'name' => 'Vue.js',
                'slug' => 'vuejs',
                'icon' => 'heroicon-o-sparkles',
                'color' => '#4FC08D',
                'is_featured' => true,
            ],
            [
                'name' => 'React',
                'slug' => 'react',
                'icon' => 'heroicon-o-sparkles',
                'color' => '#61DAFB',
            ],
            [
                'name' => 'Livewire',
                'slug' => 'livewire',
                'icon' => 'heroicon-o-bolt',
                'color' => '#FB70A9',
            ],
            [
                'name' => 'Alpine.js',
                'slug' => 'alpinejs',
                'icon' => 'heroicon-o-sparkles',
                'color' => '#8BC0D0',
            ],
            [
                'name' => 'Tailwind CSS',
                'slug' => 'tailwindcss',
                'icon' => 'heroicon-o-paint-brush',
                'color' => '#06B6D4',
            ],
            [
                'name' => 'Inertia.js',
                'slug' => 'inertiajs',
                'icon' => 'heroicon-o-arrows-right-left',
                'color' => '#9553E9',
            ],

            // DevOps & Tools
            [
                'name' => 'Docker',
                'slug' => 'docker',
                'icon' => 'heroicon-o-cube',
                'color' => '#2496ED',
                'is_featured' => true,
            ],
            [
                'name' => 'AWS',
                'slug' => 'aws',
                'icon' => 'heroicon-o-cloud',
                'color' => '#FF9900',
            ],
            [
                'name' => 'DigitalOcean',
                'slug' => 'digitalocean',
                'icon' => 'heroicon-o-cloud',
                'color' => '#0080FF',
            ],
            [
                'name' => 'Git',
                'slug' => 'git',
                'icon' => 'heroicon-o-code-bracket-square',
                'color' => '#F05032',
                'is_featured' => true,
            ],
            [
                'name' => 'GitHub Actions',
                'slug' => 'github-actions',
                'icon' => 'heroicon-o-play-circle',
                'color' => '#2088FF',
            ],
            [
                'name' => 'Nginx',
                'slug' => 'nginx',
                'icon' => 'heroicon-o-server',
                'color' => '#009639',
            ],
            [
                'name' => 'Linux',
                'slug' => 'linux',
                'icon' => 'heroicon-o-command-line',
                'color' => '#FCC624',
            ],

            // APIs & Services
            [
                'name' => 'REST API',
                'slug' => 'rest-api',
                'icon' => 'heroicon-o-arrows-right-left',
                'color' => '#009688',
                'is_featured' => true,
            ],
            [
                'name' => 'GraphQL',
                'slug' => 'graphql',
                'icon' => 'heroicon-o-share',
                'color' => '#E10098',
            ],
            [
                'name' => 'WebSockets',
                'slug' => 'websockets',
                'icon' => 'heroicon-o-signal',
                'color' => '#010101',
            ],
            [
                'name' => 'Stripe',
                'slug' => 'stripe',
                'icon' => 'heroicon-o-credit-card',
                'color' => '#635BFF',
            ],
            [
                'name' => 'PayPal',
                'slug' => 'paypal',
                'icon' => 'heroicon-o-credit-card',
                'color' => '#00457C',
            ],
            [
                'name' => 'Pusher',
                'slug' => 'pusher',
                'icon' => 'heroicon-o-signal',
                'color' => '#300D4F',
            ],

            // Testing
            [
                'name' => 'PHPUnit',
                'slug' => 'phpunit',
                'icon' => 'heroicon-o-beaker',
                'color' => '#3C9CD7',
            ],
            [
                'name' => 'Pest',
                'slug' => 'pest',
                'icon' => 'heroicon-o-beaker',
                'color' => '#F472B6',
            ],
            [
                'name' => 'Jest',
                'slug' => 'jest',
                'icon' => 'heroicon-o-beaker',
                'color' => '#C21325',
            ],
        ];

        foreach ($techStacks as $tech) {
            TechStack::updateOrCreate(
                ['slug' => $tech['slug']],
                $tech
            );
        }
    }
}
