<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'client_name' => 'Sarah Mitchell',
                'client_position' => 'CTO',
                'client_company' => 'TechVentures Inc.',
                'content' => [
                    'en' => 'Abdelrahman delivered exceptional work on our SaaS platform. His expertise in Laravel and system architecture helped us scale from 100 to 5,000 users without any performance issues. His communication was excellent throughout the project, and he consistently went above and beyond our expectations.',
                    'ar' => 'قدم عبدالرحمن عملاً استثنائياً على منصة SaaS الخاصة بنا. ساعدتنا خبرته في Laravel وهندسة النظام على التوسع من 100 إلى 5,000 مستخدم دون أي مشاكل في الأداء. كان تواصله ممتازاً طوال المشروع، وتجاوز توقعاتنا باستمرار.',
                ],
                'rating' => 5,
                'is_featured' => true,
                'is_published' => true,
            ],
            [
                'client_name' => 'Ahmed Hassan',
                'client_position' => 'Founder & CEO',
                'client_company' => 'ShopConnect Ltd.',
                'content' => [
                    'en' => 'Working with Abdelrahman was a game-changer for our e-commerce platform. He redesigned our entire backend architecture, resulting in a 60% improvement in page load times and a significant increase in our conversion rates. Highly professional and knowledgeable.',
                    'ar' => 'كان العمل مع عبدالرحمن نقطة تحول لمنصة التجارة الإلكترونية الخاصة بنا. أعاد تصميم بنية الواجهة الخلفية بالكامل، مما أدى إلى تحسن بنسبة 60٪ في أوقات تحميل الصفحات وزيادة كبيرة في معدلات التحويل. محترف وذو معرفة عالية.',
                ],
                'rating' => 5,
                'is_featured' => true,
                'is_published' => true,
            ],
            [
                'client_name' => 'Dr. Lisa Chen',
                'client_position' => 'Director of Technology',
                'client_company' => 'MedCare Solutions',
                'content' => [
                    'en' => 'The healthcare management system Abdelrahman built for us exceeded all expectations. His attention to HIPAA compliance and security best practices gave us complete confidence in the solution. He understood the unique requirements of healthcare software perfectly.',
                    'ar' => 'تجاوز نظام إدارة الرعاية الصحية الذي بناه عبدالرحمن لنا جميع التوقعات. منحنا اهتمامه بامتثال HIPAA وأفضل ممارسات الأمان ثقة كاملة في الحل. فهم المتطلبات الفريدة لبرامج الرعاية الصحية بشكل مثالي.',
                ],
                'rating' => 5,
                'is_featured' => true,
                'is_published' => true,
            ],
            [
                'client_name' => 'Michael Rodriguez',
                'client_position' => 'Product Manager',
                'client_company' => 'FastShip Logistics',
                'content' => [
                    'en' => 'Abdelrahman transformed our logistics operations with the tracking system he developed. The real-time GPS tracking and route optimization features have saved us thousands in operational costs. He is responsive, detail-oriented, and delivers on time.',
                    'ar' => 'حوّل عبدالرحمن عملياتنا اللوجستية من خلال نظام التتبع الذي طوره. وفرت لنا ميزات تتبع GPS في الوقت الفعلي وتحسين المسار آلاف الدولارات في تكاليف التشغيل. إنه سريع الاستجابة ودقيق ويسلم في الوقت المحدد.',
                ],
                'rating' => 5,
                'is_featured' => false,
                'is_published' => true,
            ],
            [
                'client_name' => 'Emma Thompson',
                'client_position' => 'Marketing Director',
                'client_company' => 'Premier Realty Group',
                'content' => [
                    'en' => 'The CRM platform Abdelrahman created has revolutionized how our agents manage leads and properties. The intuitive interface and powerful features have increased our team productivity by 40%. He truly understands business requirements.',
                    'ar' => 'أحدثت منصة CRM التي أنشأها عبدالرحمن ثورة في كيفية إدارة وكلائنا للعملاء المحتملين والعقارات. زادت الواجهة البديهية والميزات القوية من إنتاجية فريقنا بنسبة 40٪. إنه يفهم حقاً متطلبات العمل.',
                ],
                'rating' => 5,
                'is_featured' => false,
                'is_published' => true,
            ],
            [
                'client_name' => 'David Kim',
                'client_position' => 'Senior Developer',
                'client_company' => 'Open Source Community',
                'content' => [
                    'en' => 'Abdelrahman\'s Laravel API Toolkit package is a must-have for any serious API development. The code quality is excellent, documentation is comprehensive, and he actively maintains the project. A true asset to the Laravel community.',
                    'ar' => 'حزمة أدوات Laravel API الخاصة بعبدالرحمن ضرورية لأي تطوير API جاد. جودة الكود ممتازة والتوثيق شامل وهو يحافظ بنشاط على المشروع. إضافة حقيقية لمجتمع Laravel.',
                ],
                'rating' => 5,
                'is_featured' => false,
                'is_published' => true,
            ],
            [
                'client_name' => 'Fatima Al-Rashid',
                'client_position' => 'Operations Manager',
                'client_company' => 'Gulf Trade Co.',
                'content' => [
                    'en' => 'We hired Abdelrahman to modernize our legacy PHP application. He meticulously planned the migration to Laravel, ensuring zero downtime during the transition. The new system is faster, more secure, and much easier to maintain.',
                    'ar' => 'وظفنا عبدالرحمن لتحديث تطبيق PHP القديم الخاص بنا. خطط بدقة للترحيل إلى Laravel، مما يضمن عدم وجود توقف أثناء الانتقال. النظام الجديد أسرع وأكثر أماناً وأسهل بكثير في الصيانة.',
                ],
                'rating' => 5,
                'is_featured' => true,
                'is_published' => true,
            ],
            [
                'client_name' => 'James Wilson',
                'client_position' => 'Startup Founder',
                'client_company' => 'NextGen Apps',
                'content' => [
                    'en' => 'As a startup, we needed a developer who could move fast without sacrificing quality. Abdelrahman delivered our MVP in record time with clean, scalable code. He\'s become our go-to developer for all backend work.',
                    'ar' => 'كشركة ناشئة، كنا بحاجة إلى مطور يمكنه التحرك بسرعة دون التضحية بالجودة. سلم عبدالرحمن MVP الخاص بنا في وقت قياسي مع كود نظيف وقابل للتطوير. أصبح مطورنا المفضل لجميع أعمال الواجهة الخلفية.',
                ],
                'rating' => 5,
                'is_featured' => false,
                'is_published' => true,
            ],
        ];

        foreach ($testimonials as $index => $testimonial) {
            Testimonial::updateOrCreate(
                [
                    'client_name' => $testimonial['client_name'],
                    'client_company' => $testimonial['client_company'],
                ],
                $testimonial
            );
        }
    }
}
