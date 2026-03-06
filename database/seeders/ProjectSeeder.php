<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectFeature;
use App\Models\TechStack;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'slug' => 'enterprise-saas-platform',
                'title' => [
                    'en' => 'Enterprise SaaS Platform',
                    'ar' => 'منصة SaaS للمؤسسات',
                ],
                'description' => [
                    'en' => 'A comprehensive multi-tenant SaaS platform with subscription management, team collaboration, and advanced analytics dashboard.',
                    'ar' => 'منصة SaaS شاملة متعددة المستأجرين مع إدارة الاشتراكات والتعاون الجماعي ولوحة تحليلات متقدمة.',
                ],
                'content' => [
                    'en' => '<h2>Project Overview</h2><p>Built a scalable multi-tenant SaaS platform serving 500+ businesses with real-time collaboration features. The platform handles millions of transactions monthly with 99.9% uptime.</p><h2>Technical Challenges</h2><p>Implemented a robust multi-tenancy architecture using database-per-tenant approach for data isolation while maintaining shared codebase. Designed custom queue workers for handling background jobs efficiently.</p><h2>Key Achievements</h2><ul><li>Reduced page load times by 60% through query optimization and Redis caching</li><li>Implemented real-time notifications using WebSockets</li><li>Built comprehensive API for mobile app integration</li><li>Achieved SOC 2 Type II compliance</li></ul>',
                    'ar' => '<h2>نظرة عامة على المشروع</h2><p>بناء منصة SaaS قابلة للتطوير متعددة المستأجرين تخدم أكثر من 500 شركة مع ميزات التعاون في الوقت الفعلي. تتعامل المنصة مع ملايين المعاملات شهرياً بوقت تشغيل 99.9%.</p><h2>التحديات التقنية</h2><p>تنفيذ بنية متعددة المستأجرين قوية باستخدام نهج قاعدة بيانات لكل مستأجر لعزل البيانات مع الحفاظ على قاعدة كود مشتركة.</p>',
                ],
                'client_name' => 'TechVentures Inc.',
                'project_url' => 'https://example-saas.com',
                'github_url' => null,
                'start_date' => '2023-01-15',
                'end_date' => '2023-08-30',
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 1,
                'tech_stacks' => ['laravel', 'vuejs', 'mysql', 'redis', 'docker', 'aws', 'websockets', 'stripe'],
                'features' => [
                    [
                        'title' => ['en' => 'Multi-Tenant Architecture', 'ar' => 'بنية متعددة المستأجرين'],
                        'description' => ['en' => 'Isolated databases for each tenant ensuring data security and scalability', 'ar' => 'قواعد بيانات معزولة لكل مستأجر تضمن أمان البيانات وقابلية التوسع'],
                        'icon' => 'heroicon-o-building-office-2',
                        'sort_order' => 1,
                    ],
                    [
                        'title' => ['en' => 'Real-time Collaboration', 'ar' => 'التعاون في الوقت الفعلي'],
                        'description' => ['en' => 'WebSocket-powered live updates and team collaboration features', 'ar' => 'تحديثات مباشرة مدعومة بـ WebSocket وميزات التعاون الجماعي'],
                        'icon' => 'heroicon-o-users',
                        'sort_order' => 2,
                    ],
                    [
                        'title' => ['en' => 'Analytics Dashboard', 'ar' => 'لوحة التحليلات'],
                        'description' => ['en' => 'Comprehensive analytics with customizable reports and data visualization', 'ar' => 'تحليلات شاملة مع تقارير قابلة للتخصيص وتصور البيانات'],
                        'icon' => 'heroicon-o-chart-bar',
                        'sort_order' => 3,
                    ],
                ],
            ],
            [
                'slug' => 'ecommerce-marketplace',
                'title' => [
                    'en' => 'Multi-Vendor E-Commerce Marketplace',
                    'ar' => 'سوق التجارة الإلكترونية متعدد البائعين',
                ],
                'description' => [
                    'en' => 'A feature-rich marketplace platform connecting vendors with customers, featuring advanced search, recommendation engine, and secure payment processing.',
                    'ar' => 'منصة سوق غنية بالميزات تربط البائعين بالعملاء، مع بحث متقدم ومحرك توصيات ومعالجة دفع آمنة.',
                ],
                'content' => [
                    'en' => '<h2>Project Overview</h2><p>Developed a multi-vendor marketplace handling 10,000+ products with advanced filtering, real-time inventory management, and automated vendor payouts.</p><h2>Key Features</h2><ul><li>AI-powered product recommendations</li><li>Multi-currency and multi-language support</li><li>Vendor dashboard with sales analytics</li><li>Automated commission calculations and payouts</li></ul>',
                    'ar' => '<h2>نظرة عامة على المشروع</h2><p>تطوير سوق متعدد البائعين يتعامل مع أكثر من 10,000 منتج مع تصفية متقدمة وإدارة المخزون في الوقت الفعلي ودفعات البائعين الآلية.</p>',
                ],
                'client_name' => 'ShopConnect Ltd.',
                'project_url' => 'https://example-marketplace.com',
                'github_url' => null,
                'start_date' => '2023-03-01',
                'end_date' => '2023-11-15',
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 2,
                'tech_stacks' => ['laravel', 'livewire', 'mysql', 'redis', 'elasticsearch', 'stripe', 'aws'],
                'features' => [
                    [
                        'title' => ['en' => 'Smart Search', 'ar' => 'البحث الذكي'],
                        'description' => ['en' => 'Elasticsearch-powered search with filters and autocomplete', 'ar' => 'بحث مدعوم بـ Elasticsearch مع فلاتر والإكمال التلقائي'],
                        'icon' => 'heroicon-o-magnifying-glass',
                        'sort_order' => 1,
                    ],
                    [
                        'title' => ['en' => 'Vendor Portal', 'ar' => 'بوابة البائع'],
                        'description' => ['en' => 'Complete vendor management with inventory and order tracking', 'ar' => 'إدارة كاملة للبائع مع المخزون وتتبع الطلبات'],
                        'icon' => 'heroicon-o-building-storefront',
                        'sort_order' => 2,
                    ],
                ],
            ],
            [
                'slug' => 'healthcare-management-system',
                'title' => [
                    'en' => 'Healthcare Management System',
                    'ar' => 'نظام إدارة الرعاية الصحية',
                ],
                'description' => [
                    'en' => 'A HIPAA-compliant healthcare platform for clinics with appointment scheduling, patient records, billing, and telemedicine integration.',
                    'ar' => 'منصة رعاية صحية متوافقة مع HIPAA للعيادات مع جدولة المواعيد وسجلات المرضى والفواتير وتكامل الطب عن بعد.',
                ],
                'content' => [
                    'en' => '<h2>Project Overview</h2><p>Built a comprehensive healthcare management system serving 50+ clinics with full HIPAA compliance. The system manages patient records, appointments, prescriptions, and billing.</p><h2>Security Measures</h2><p>Implemented end-to-end encryption, audit logging, role-based access control, and automatic session timeout to meet healthcare compliance requirements.</p>',
                    'ar' => '<h2>نظرة عامة على المشروع</h2><p>بناء نظام إدارة رعاية صحية شامل يخدم أكثر من 50 عيادة مع امتثال كامل لـ HIPAA.</p>',
                ],
                'client_name' => 'MedCare Solutions',
                'project_url' => null,
                'github_url' => null,
                'start_date' => '2022-06-01',
                'end_date' => '2023-02-28',
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 3,
                'tech_stacks' => ['laravel', 'vuejs', 'postgresql', 'redis', 'docker', 'aws'],
                'features' => [
                    [
                        'title' => ['en' => 'HIPAA Compliance', 'ar' => 'امتثال HIPAA'],
                        'description' => ['en' => 'Full compliance with healthcare data protection regulations', 'ar' => 'امتثال كامل للوائح حماية بيانات الرعاية الصحية'],
                        'icon' => 'heroicon-o-shield-check',
                        'sort_order' => 1,
                    ],
                    [
                        'title' => ['en' => 'Telemedicine', 'ar' => 'الطب عن بعد'],
                        'description' => ['en' => 'Video consultations with integrated scheduling', 'ar' => 'استشارات بالفيديو مع جدولة متكاملة'],
                        'icon' => 'heroicon-o-video-camera',
                        'sort_order' => 2,
                    ],
                ],
            ],
            [
                'slug' => 'real-estate-crm',
                'title' => [
                    'en' => 'Real Estate CRM Platform',
                    'ar' => 'منصة CRM للعقارات',
                ],
                'description' => [
                    'en' => 'A comprehensive CRM solution for real estate agencies with property listings, lead management, automated follow-ups, and reporting.',
                    'ar' => 'حل CRM شامل لوكالات العقارات مع قوائم العقارات وإدارة العملاء المحتملين والمتابعة الآلية والتقارير.',
                ],
                'content' => [
                    'en' => '<h2>Project Overview</h2><p>Developed a specialized CRM for real estate professionals that streamlines property management, client relationships, and sales pipelines. The platform integrates with MLS systems and social media for property syndication.</p>',
                    'ar' => '<h2>نظرة عامة على المشروع</h2><p>تطوير CRM متخصص لمحترفي العقارات يبسط إدارة الممتلكات وعلاقات العملاء وخطوط المبيعات.</p>',
                ],
                'client_name' => 'Premier Realty Group',
                'project_url' => 'https://example-realty.com',
                'github_url' => null,
                'start_date' => '2023-05-01',
                'end_date' => '2023-10-30',
                'is_featured' => false,
                'is_published' => true,
                'sort_order' => 4,
                'tech_stacks' => ['laravel', 'livewire', 'alpinejs', 'tailwindcss', 'mysql', 'redis'],
                'features' => [
                    [
                        'title' => ['en' => 'Lead Management', 'ar' => 'إدارة العملاء المحتملين'],
                        'description' => ['en' => 'Track and nurture leads through the sales pipeline', 'ar' => 'تتبع ورعاية العملاء المحتملين عبر خط المبيعات'],
                        'icon' => 'heroicon-o-user-group',
                        'sort_order' => 1,
                    ],
                    [
                        'title' => ['en' => 'Property Listings', 'ar' => 'قوائم العقارات'],
                        'description' => ['en' => 'Comprehensive property management with virtual tours', 'ar' => 'إدارة عقارات شاملة مع جولات افتراضية'],
                        'icon' => 'heroicon-o-home',
                        'sort_order' => 2,
                    ],
                ],
            ],
            [
                'slug' => 'logistics-tracking-system',
                'title' => [
                    'en' => 'Logistics & Delivery Tracking System',
                    'ar' => 'نظام تتبع الخدمات اللوجستية والتوصيل',
                ],
                'description' => [
                    'en' => 'Real-time shipment tracking platform with route optimization, driver management, and customer notifications.',
                    'ar' => 'منصة تتبع الشحنات في الوقت الفعلي مع تحسين المسار وإدارة السائقين وإشعارات العملاء.',
                ],
                'content' => [
                    'en' => '<h2>Project Overview</h2><p>Built a logistics management system processing 50,000+ deliveries monthly with real-time GPS tracking, automated route optimization, and comprehensive analytics.</p><h2>Technical Implementation</h2><p>Implemented geolocation services, push notifications, and real-time WebSocket updates for live tracking. Built a mobile-first driver app companion.</p>',
                    'ar' => '<h2>نظرة عامة على المشروع</h2><p>بناء نظام إدارة لوجستيات يعالج أكثر من 50,000 توصيل شهرياً مع تتبع GPS في الوقت الفعلي.</p>',
                ],
                'client_name' => 'FastShip Logistics',
                'project_url' => null,
                'github_url' => null,
                'start_date' => '2022-09-01',
                'end_date' => '2023-04-15',
                'is_featured' => false,
                'is_published' => true,
                'sort_order' => 5,
                'tech_stacks' => ['laravel', 'vuejs', 'postgresql', 'redis', 'websockets', 'docker'],
                'features' => [
                    [
                        'title' => ['en' => 'Real-time Tracking', 'ar' => 'التتبع في الوقت الفعلي'],
                        'description' => ['en' => 'GPS-powered live shipment tracking with ETA updates', 'ar' => 'تتبع الشحنات المباشر المدعوم بـ GPS مع تحديثات الوقت المتوقع'],
                        'icon' => 'heroicon-o-map-pin',
                        'sort_order' => 1,
                    ],
                    [
                        'title' => ['en' => 'Route Optimization', 'ar' => 'تحسين المسار'],
                        'description' => ['en' => 'AI-powered route planning for efficient deliveries', 'ar' => 'تخطيط المسار المدعوم بالذكاء الاصطناعي للتوصيل الفعال'],
                        'icon' => 'heroicon-o-arrows-pointing-out',
                        'sort_order' => 2,
                    ],
                ],
            ],
            [
                'slug' => 'open-source-laravel-package',
                'title' => [
                    'en' => 'Laravel API Toolkit Package',
                    'ar' => 'حزمة أدوات Laravel API',
                ],
                'description' => [
                    'en' => 'An open-source Laravel package providing utilities for building robust APIs with rate limiting, caching, and comprehensive documentation.',
                    'ar' => 'حزمة Laravel مفتوحة المصدر توفر أدوات لبناء واجهات برمجة قوية مع تحديد المعدل والتخزين المؤقت والتوثيق الشامل.',
                ],
                'content' => [
                    'en' => '<h2>Project Overview</h2><p>Created and maintain an open-source Laravel package that simplifies API development. The package includes response transformers, exception handling, rate limiting decorators, and auto-generated documentation.</p><h2>Community Impact</h2><ul><li>2,000+ GitHub stars</li><li>50,000+ monthly downloads</li><li>Active community with 20+ contributors</li></ul>',
                    'ar' => '<h2>نظرة عامة على المشروع</h2><p>إنشاء وصيانة حزمة Laravel مفتوحة المصدر تبسط تطوير واجهات البرمجة.</p>',
                ],
                'client_name' => 'Open Source',
                'project_url' => null,
                'github_url' => 'https://github.com/example/laravel-api-toolkit',
                'start_date' => '2022-01-01',
                'end_date' => null,
                'is_featured' => false,
                'is_published' => true,
                'sort_order' => 6,
                'tech_stacks' => ['laravel', 'php', 'rest-api', 'phpunit', 'pest', 'git', 'github-actions'],
                'features' => [
                    [
                        'title' => ['en' => 'Response Transformers', 'ar' => 'محولات الاستجابة'],
                        'description' => ['en' => 'Consistent API response formatting with pagination support', 'ar' => 'تنسيق استجابة API متسق مع دعم التصفح'],
                        'icon' => 'heroicon-o-arrows-right-left',
                        'sort_order' => 1,
                    ],
                    [
                        'title' => ['en' => 'Auto Documentation', 'ar' => 'التوثيق التلقائي'],
                        'description' => ['en' => 'Generate OpenAPI documentation from your code', 'ar' => 'توليد توثيق OpenAPI من الكود الخاص بك'],
                        'icon' => 'heroicon-o-document-text',
                        'sort_order' => 2,
                    ],
                ],
            ],
        ];

        foreach ($projects as $projectData) {
            $techStackSlugs = $projectData['tech_stacks'] ?? [];
            $featuresData = $projectData['features'] ?? [];

            unset($projectData['tech_stacks'], $projectData['features']);

            $project = Project::updateOrCreate(
                ['slug' => $projectData['slug']],
                $projectData
            );

            // Attach tech stacks
            if (! empty($techStackSlugs)) {
                $techStackIds = TechStack::whereIn('slug', $techStackSlugs)->pluck('id');
                $project->techStacks()->sync($techStackIds);
            }

            // Create features
            if (! empty($featuresData)) {
                $project->features()->delete(); // Clear existing features

                foreach ($featuresData as $featureData) {
                    $project->features()->create($featureData);
                }
            }
        }
    }
}
