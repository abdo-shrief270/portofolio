<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            // Backend Development
            [
                'name' => ['en' => 'PHP', 'ar' => 'PHP'],
                'category' => 'backend',
                'proficiency' => 95,
                'sort_order' => 1,
            ],
            [
                'name' => ['en' => 'Laravel', 'ar' => 'لارافيل'],
                'category' => 'backend',
                'proficiency' => 95,
                'sort_order' => 2,
            ],
            [
                'name' => ['en' => 'Node.js', 'ar' => 'نود جي اس'],
                'category' => 'backend',
                'proficiency' => 80,
                'sort_order' => 3,
            ],
            [
                'name' => ['en' => 'Python', 'ar' => 'بايثون'],
                'category' => 'backend',
                'proficiency' => 75,
                'sort_order' => 4,
            ],
            [
                'name' => ['en' => 'REST API Design', 'ar' => 'تصميم واجهات REST'],
                'category' => 'backend',
                'proficiency' => 95,
                'sort_order' => 5,
            ],
            [
                'name' => ['en' => 'GraphQL', 'ar' => 'جراف كيو ال'],
                'category' => 'backend',
                'proficiency' => 85,
                'sort_order' => 6,
            ],

            // Database
            [
                'name' => ['en' => 'MySQL', 'ar' => 'ماي اس كيو ال'],
                'category' => 'database',
                'proficiency' => 95,
                'sort_order' => 1,
            ],
            [
                'name' => ['en' => 'PostgreSQL', 'ar' => 'بوستجري اس كيو ال'],
                'category' => 'database',
                'proficiency' => 90,
                'sort_order' => 2,
            ],
            [
                'name' => ['en' => 'MongoDB', 'ar' => 'مونجو دي بي'],
                'category' => 'database',
                'proficiency' => 80,
                'sort_order' => 3,
            ],
            [
                'name' => ['en' => 'Redis', 'ar' => 'ريديس'],
                'category' => 'database',
                'proficiency' => 90,
                'sort_order' => 4,
            ],
            [
                'name' => ['en' => 'Elasticsearch', 'ar' => 'الاستيك سيرش'],
                'category' => 'database',
                'proficiency' => 75,
                'sort_order' => 5,
            ],

            // Frontend
            [
                'name' => ['en' => 'Vue.js', 'ar' => 'فيو جي اس'],
                'category' => 'frontend',
                'proficiency' => 85,
                'sort_order' => 1,
            ],
            [
                'name' => ['en' => 'React', 'ar' => 'رياكت'],
                'category' => 'frontend',
                'proficiency' => 75,
                'sort_order' => 2,
            ],
            [
                'name' => ['en' => 'Livewire', 'ar' => 'لايف واير'],
                'category' => 'frontend',
                'proficiency' => 95,
                'sort_order' => 3,
            ],
            [
                'name' => ['en' => 'Alpine.js', 'ar' => 'ألباين جي اس'],
                'category' => 'frontend',
                'proficiency' => 90,
                'sort_order' => 4,
            ],
            [
                'name' => ['en' => 'Tailwind CSS', 'ar' => 'تيلويند'],
                'category' => 'frontend',
                'proficiency' => 95,
                'sort_order' => 5,
            ],

            // DevOps
            [
                'name' => ['en' => 'Docker', 'ar' => 'دوكر'],
                'category' => 'devops',
                'proficiency' => 90,
                'sort_order' => 1,
            ],
            [
                'name' => ['en' => 'AWS', 'ar' => 'أمازون ويب سيرفيسز'],
                'category' => 'devops',
                'proficiency' => 85,
                'sort_order' => 2,
            ],
            [
                'name' => ['en' => 'CI/CD Pipelines', 'ar' => 'أنابيب CI/CD'],
                'category' => 'devops',
                'proficiency' => 90,
                'sort_order' => 3,
            ],
            [
                'name' => ['en' => 'Linux Server Administration', 'ar' => 'إدارة خوادم لينكس'],
                'category' => 'devops',
                'proficiency' => 90,
                'sort_order' => 4,
            ],
            [
                'name' => ['en' => 'Nginx', 'ar' => 'إنجينكس'],
                'category' => 'devops',
                'proficiency' => 90,
                'sort_order' => 5,
            ],

            // Tools & Practices
            [
                'name' => ['en' => 'Git & Version Control', 'ar' => 'جيت والتحكم بالإصدارات'],
                'category' => 'tools',
                'proficiency' => 95,
                'sort_order' => 1,
            ],
            [
                'name' => ['en' => 'PHPUnit & Pest Testing', 'ar' => 'اختبارات PHPUnit و Pest'],
                'category' => 'tools',
                'proficiency' => 90,
                'sort_order' => 2,
            ],
            [
                'name' => ['en' => 'Code Review', 'ar' => 'مراجعة الكود'],
                'category' => 'tools',
                'proficiency' => 95,
                'sort_order' => 3,
            ],
            [
                'name' => ['en' => 'Agile/Scrum', 'ar' => 'أجايل/سكرام'],
                'category' => 'tools',
                'proficiency' => 90,
                'sort_order' => 4,
            ],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(
                [
                    'category' => $skill['category'],
                    'sort_order' => $skill['sort_order'],
                ],
                $skill
            );
        }
    }
}
