<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => ['en' => 'Laravel', 'ar' => 'لارافيل'],
                'slug' => 'laravel',
            ],
            [
                'name' => ['en' => 'PHP', 'ar' => 'PHP'],
                'slug' => 'php',
            ],
            [
                'name' => ['en' => 'API Development', 'ar' => 'تطوير واجهات البرمجة'],
                'slug' => 'api-development',
            ],
            [
                'name' => ['en' => 'Database', 'ar' => 'قواعد البيانات'],
                'slug' => 'database',
            ],
            [
                'name' => ['en' => 'DevOps', 'ar' => 'DevOps'],
                'slug' => 'devops',
            ],
            [
                'name' => ['en' => 'Best Practices', 'ar' => 'أفضل الممارسات'],
                'slug' => 'best-practices',
            ],
            [
                'name' => ['en' => 'Performance', 'ar' => 'الأداء'],
                'slug' => 'performance',
            ],
            [
                'name' => ['en' => 'Security', 'ar' => 'الأمان'],
                'slug' => 'security',
            ],
        ];

        foreach ($categories as $category) {
            BlogCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
