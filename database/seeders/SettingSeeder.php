<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General Settings
            [
                'key' => 'site_name',
                'value' => [
                    'en' => 'Abdelrahman Shrief - Senior Backend Developer',
                    'ar' => 'عبدالرحمن شريف - مطور واجهات خلفية أول',
                ],
                'group' => 'general',
            ],
            [
                'key' => 'site_tagline',
                'value' => [
                    'en' => 'Building Scalable Backend Solutions with Laravel & PHP',
                    'ar' => 'بناء حلول خلفية قابلة للتطوير مع Laravel و PHP',
                ],
                'group' => 'general',
            ],
            [
                'key' => 'site_description',
                'value' => [
                    'en' => 'Senior Backend Developer specializing in Laravel, PHP, and modern web technologies. Creating robust, scalable applications for businesses worldwide.',
                    'ar' => 'مطور واجهات خلفية أول متخصص في Laravel و PHP وتقنيات الويب الحديثة. إنشاء تطبيقات قوية وقابلة للتطوير للشركات في جميع أنحاء العالم.',
                ],
                'group' => 'general',
            ],

            // Contact Settings
            [
                'key' => 'contact_email',
                'value' => ['en' => 'dev.abdo.shrief@gmail.com', 'ar' => 'dev.abdo.shrief@gmail.com'],
                'group' => 'contact',
            ],
            [
                'key' => 'contact_phone',
                'value' => ['en' => '+201555440882', 'ar' => '+201555440882'],
                'group' => 'contact',
            ],
            [
                'key' => 'contact_whatsapp',
                'value' => ['en' => '+201555440882', 'ar' => '+201555440882'],
                'group' => 'contact',
            ],
            [
                'key' => 'contact_address',
                'value' => [
                    'en' => 'Cairo, Egypt',
                    'ar' => 'القاهرة، مصر',
                ],
                'group' => 'contact',
            ],

            // Social Media
            [
                'key' => 'social_github',
                'value' => ['en' => 'https://github.com/abdo-shrief', 'ar' => 'https://github.com/abdo-shrief'],
                'group' => 'social',
            ],
            [
                'key' => 'social_linkedin',
                'value' => ['en' => 'https://linkedin.com/in/abdo-shrief', 'ar' => 'https://linkedin.com/in/abdo-shrief'],
                'group' => 'social',
            ],
            [
                'key' => 'social_twitter',
                'value' => ['en' => 'https://twitter.com/abdo_shrief', 'ar' => 'https://twitter.com/abdo_shrief'],
                'group' => 'social',
            ],

            // About Page
            [
                'key' => 'about_intro',
                'value' => [
                    'en' => "I'm a passionate Senior Backend Developer with over 7 years of experience building scalable web applications. I specialize in Laravel, PHP, and modern backend technologies, helping businesses transform their ideas into robust digital solutions.",
                    'ar' => 'أنا مطور واجهات خلفية أول شغوف مع أكثر من 7 سنوات من الخبرة في بناء تطبيقات ويب قابلة للتطوير. أتخصص في Laravel و PHP وتقنيات الواجهات الخلفية الحديثة، مما يساعد الشركات على تحويل أفكارها إلى حلول رقمية قوية.',
                ],
                'group' => 'about',
            ],
            [
                'key' => 'about_experience_years',
                'value' => ['en' => '7+', 'ar' => '7+'],
                'group' => 'about',
            ],
            [
                'key' => 'about_projects_completed',
                'value' => ['en' => '50+', 'ar' => '50+'],
                'group' => 'about',
            ],
            [
                'key' => 'about_clients_served',
                'value' => ['en' => '30+', 'ar' => '30+'],
                'group' => 'about',
            ],
            [
                'key' => 'about_story',
                'value' => [
                    'en' => "With over 7 years of experience in backend development, I specialize in building robust, scalable applications using Laravel, PHP, and modern web technologies.\n\nMy approach combines clean code practices with user-centered design to deliver solutions that not only work flawlessly but also provide an exceptional user experience.\n\nI'm passionate about staying current with industry trends and continuously improving my skills to provide the best possible solutions for my clients.",
                    'ar' => "مع أكثر من 7 سنوات من الخبرة في تطوير الواجهات الخلفية، أتخصص في بناء تطبيقات قوية وقابلة للتطوير باستخدام Laravel و PHP وتقنيات الويب الحديثة.\n\nيجمع نهجي بين ممارسات الكود النظيف والتصميم المرتكز على المستخدم لتقديم حلول لا تعمل بشكل مثالي فحسب، بل توفر أيضاً تجربة مستخدم استثنائية.\n\nأنا شغوف بمواكبة اتجاهات الصناعة وتحسين مهاراتي باستمرار لتقديم أفضل الحلول الممكنة لعملائي.",
                ],
                'group' => 'about',
            ],

            // SEO Settings
            [
                'key' => 'seo_keywords',
                'value' => [
                    'en' => 'Laravel Developer, PHP Developer, Backend Developer, API Development, Web Application Developer, Full Stack Developer, Senior Developer, Egypt Developer',
                    'ar' => 'مطور Laravel، مطور PHP، مطور واجهات خلفية، تطوير API، مطور تطبيقات ويب، مطور فول ستاك، مطور أول، مطور مصر',
                ],
                'group' => 'seo',
            ],
            [
                'key' => 'seo_author',
                'value' => [
                    'en' => 'Abdelrahman Shrief Ali',
                    'ar' => 'عبدالرحمن شريف علي',
                ],
                'group' => 'seo',
            ],

            // Quote Page Settings
            [
                'key' => 'quote_intro',
                'value' => [
                    'en' => "Have a project in mind? I'd love to hear about it. Fill out the form below and I'll get back to you within 24 hours to discuss how we can work together.",
                    'ar' => 'هل لديك مشروع في ذهنك؟ أود أن أسمع عنه. املأ النموذج أدناه وسأرد عليك خلال 24 ساعة لمناقشة كيف يمكننا العمل معاً.',
                ],
                'group' => 'quote',
            ],
            [
                'key' => 'quote_budget_ranges',
                'value' => [
                    'en' => '$1,000 - $5,000|$5,000 - $10,000|$10,000 - $25,000|$25,000 - $50,000|$50,000+',
                    'ar' => '$1,000 - $5,000|$5,000 - $10,000|$10,000 - $25,000|$25,000 - $50,000|$50,000+',
                ],
                'group' => 'quote',
            ],
            [
                'key' => 'quote_project_types',
                'value' => [
                    'en' => 'Web Application|E-Commerce|API Development|Consultation|Other',
                    'ar' => 'تطبيق ويب|التجارة الإلكترونية|تطوير واجهات البرمجة|استشارة|أخرى',
                ],
                'group' => 'quote',
            ],

            // Profile
            [
                'key' => 'profile_image',
                'value' => ['en' => '/assets/profile_image.jpg', 'ar' => '/assets/profile_image.jpg'],
                'group' => 'profile',
            ],
            [
                'key' => 'profile_name',
                'value' => [
                    'en' => 'Abdelrahman Shrief',
                    'ar' => 'عبدالرحمن شريف',
                ],
                'group' => 'profile',
            ],
            [
                'key' => 'profile_title',
                'value' => [
                    'en' => 'Senior Backend Developer',
                    'ar' => 'مطور واجهات خلفية أول',
                ],
                'group' => 'profile',
            ],

            // Availability
            [
                'key' => 'availability_status',
                'value' => [
                    'en' => 'Available for new projects',
                    'ar' => 'متاح لمشاريع جديدة',
                ],
                'group' => 'general',
            ],
            [
                'key' => 'availability_color',
                'value' => ['en' => 'green', 'ar' => 'green'],
                'group' => 'general',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
