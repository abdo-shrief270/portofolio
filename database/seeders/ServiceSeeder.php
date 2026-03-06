<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => [
                    'en' => 'Custom Web Application Development',
                    'ar' => 'تطوير تطبيقات الويب المخصصة',
                ],
                'description' => [
                    'en' => 'Building scalable, high-performance web applications tailored to your business needs using Laravel, PHP, and modern frameworks. From MVPs to enterprise solutions.',
                    'ar' => 'بناء تطبيقات ويب قابلة للتطوير وعالية الأداء مصممة خصيصاً لاحتياجات عملك باستخدام Laravel و PHP والأطر الحديثة. من النماذج الأولية إلى حلول المؤسسات.',
                ],
                'icon' => 'heroicon-o-code-bracket',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => [
                    'en' => 'API Development & Integration',
                    'ar' => 'تطوير وتكامل واجهات البرمجة',
                ],
                'description' => [
                    'en' => 'Designing and implementing RESTful APIs and GraphQL endpoints. Seamless integration with third-party services, payment gateways, and external platforms.',
                    'ar' => 'تصميم وتنفيذ واجهات برمجة REST و GraphQL. تكامل سلس مع خدمات الطرف الثالث وبوابات الدفع والمنصات الخارجية.',
                ],
                'icon' => 'heroicon-o-arrows-right-left',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => [
                    'en' => 'Database Design & Optimization',
                    'ar' => 'تصميم وتحسين قواعد البيانات',
                ],
                'description' => [
                    'en' => 'Expert database architecture, query optimization, and performance tuning. MySQL, PostgreSQL, MongoDB, and Redis implementation for optimal data management.',
                    'ar' => 'هندسة قواعد البيانات المتخصصة وتحسين الاستعلامات وضبط الأداء. تنفيذ MySQL و PostgreSQL و MongoDB و Redis لإدارة البيانات المثلى.',
                ],
                'icon' => 'heroicon-o-circle-stack',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'title' => [
                    'en' => 'E-Commerce Solutions',
                    'ar' => 'حلول التجارة الإلكترونية',
                ],
                'description' => [
                    'en' => 'Complete e-commerce platforms with secure payment processing, inventory management, and order fulfillment. Custom shopping experiences that convert visitors to customers.',
                    'ar' => 'منصات تجارة إلكترونية متكاملة مع معالجة دفع آمنة وإدارة المخزون وتنفيذ الطلبات. تجارب تسوق مخصصة تحول الزوار إلى عملاء.',
                ],
                'icon' => 'heroicon-o-shopping-cart',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'title' => [
                    'en' => 'Admin Panel & Dashboard Development',
                    'ar' => 'تطوير لوحات الإدارة والتحكم',
                ],
                'description' => [
                    'en' => 'Building powerful admin panels using Filament, Nova, or custom solutions. Real-time dashboards with analytics, reporting, and comprehensive management tools.',
                    'ar' => 'بناء لوحات إدارة قوية باستخدام Filament أو Nova أو حلول مخصصة. لوحات تحكم في الوقت الفعلي مع التحليلات والتقارير وأدوات الإدارة الشاملة.',
                ],
                'icon' => 'heroicon-o-chart-bar',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'title' => [
                    'en' => 'DevOps & Server Management',
                    'ar' => 'DevOps وإدارة الخوادم',
                ],
                'description' => [
                    'en' => 'Server setup, CI/CD pipeline configuration, Docker containerization, and cloud deployment on AWS or DigitalOcean. Ensuring your applications run smoothly 24/7.',
                    'ar' => 'إعداد الخوادم وتكوين CI/CD والحاويات باستخدام Docker والنشر السحابي على AWS أو DigitalOcean. ضمان تشغيل تطبيقاتك بسلاسة على مدار الساعة.',
                ],
                'icon' => 'heroicon-o-server-stack',
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'title' => [
                    'en' => 'Code Review & Consultation',
                    'ar' => 'مراجعة الكود والاستشارات',
                ],
                'description' => [
                    'en' => 'Professional code audits, architecture reviews, and technical consultation. Identifying bottlenecks, security vulnerabilities, and areas for improvement.',
                    'ar' => 'مراجعات كود احترافية ومراجعات معمارية واستشارات تقنية. تحديد الاختناقات والثغرات الأمنية ومجالات التحسين.',
                ],
                'icon' => 'heroicon-o-magnifying-glass',
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'title' => [
                    'en' => 'Legacy System Migration',
                    'ar' => 'ترحيل الأنظمة القديمة',
                ],
                'description' => [
                    'en' => 'Modernizing legacy applications with minimal disruption. Migrating from older frameworks to Laravel, upgrading PHP versions, and implementing modern best practices.',
                    'ar' => 'تحديث التطبيقات القديمة مع الحد الأدنى من التعطيل. الترحيل من الأطر القديمة إلى Laravel وترقية إصدارات PHP وتنفيذ أفضل الممارسات الحديثة.',
                ],
                'icon' => 'heroicon-o-arrow-path',
                'is_active' => true,
                'sort_order' => 8,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['sort_order' => $service['sort_order']],
                $service
            );
        }
    }
}
