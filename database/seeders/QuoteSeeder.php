<?php

namespace Database\Seeders;

use App\Models\Quote;
use Illuminate\Database\Seeder;

class QuoteSeeder extends Seeder
{
    public function run(): void
    {
        $quotes = [
            [
                'name' => 'John Smith',
                'email' => 'john.smith@techstartup.com',
                'phone' => '+1-555-123-4567',
                'company' => 'TechStartup Inc.',
                'project_type' => 'web_application',
                'budget_range' => '$10,000 - $25,000',
                'message' => 'We are looking to build a SaaS platform for project management. The application should include user authentication, team collaboration features, task management, file sharing, and real-time notifications. We need a scalable solution that can handle thousands of users.',
                'status' => 'completed',
                'notes' => 'Successfully completed project. Client was very satisfied with the delivery.',
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah@fashionstore.com',
                'phone' => '+1-555-234-5678',
                'company' => 'Fashion Store LLC',
                'project_type' => 'ecommerce',
                'budget_range' => '$15,000 - $30,000',
                'message' => 'We need a multi-vendor e-commerce platform for our fashion business. Required features include vendor management, product catalog with variants, shopping cart, multiple payment gateways (Stripe, PayPal), order tracking, and inventory management.',
                'status' => 'in_progress',
                'notes' => 'Development phase 2. Payment integration in progress.',
            ],
            [
                'name' => 'Dr. Michael Chen',
                'email' => 'mchen@medicalclinic.org',
                'phone' => '+1-555-345-6789',
                'company' => 'Medical Clinic Group',
                'project_type' => 'web_application',
                'budget_range' => '$25,000 - $50,000',
                'message' => 'Looking for a healthcare management system with patient records, appointment scheduling, prescription management, billing, and telemedicine integration. HIPAA compliance is mandatory. Need mobile-responsive design for staff access.',
                'status' => 'contacted',
                'notes' => 'Scheduled discovery call for next week. Need to discuss compliance requirements.',
            ],
            [
                'name' => 'Ahmed Al-Rashid',
                'email' => 'ahmed@gulflogistics.ae',
                'phone' => '+971-50-123-4567',
                'company' => 'Gulf Logistics Co.',
                'project_type' => 'api_development',
                'budget_range' => '$5,000 - $10,000',
                'message' => 'We need to build REST APIs for our mobile app. The APIs should handle user authentication, shipment tracking, driver management, and push notifications. Looking for someone experienced with Laravel and mobile API development.',
                'status' => 'new',
                'notes' => null,
            ],
            [
                'name' => 'Emily Watson',
                'email' => 'emily@realestatepro.com',
                'phone' => '+1-555-456-7890',
                'company' => 'Real Estate Pro',
                'project_type' => 'web_application',
                'budget_range' => '$10,000 - $25,000',
                'message' => 'Looking for a CRM system specifically designed for real estate agents. Features needed: lead management, property listings with MLS integration, email campaigns, reporting dashboard, and mobile access for agents in the field.',
                'status' => 'completed',
                'notes' => 'Project delivered successfully. Ongoing maintenance contract signed.',
            ],
            [
                'name' => 'David Park',
                'email' => 'david@edutechsolutions.io',
                'phone' => '+1-555-567-8901',
                'company' => 'EduTech Solutions',
                'project_type' => 'web_application',
                'budget_range' => '$15,000 - $30,000',
                'message' => 'We want to build an online learning management system (LMS). Should include course creation tools, video hosting integration, quiz/assessment system, progress tracking, certificates, and payment processing for course purchases.',
                'status' => 'new',
                'notes' => null,
            ],
            [
                'name' => 'Maria Garcia',
                'email' => 'maria@fooddelivery.mx',
                'phone' => '+52-555-678-9012',
                'company' => 'Food Delivery MX',
                'project_type' => 'web_application',
                'budget_range' => '$25,000 - $50,000',
                'message' => 'Building a food delivery platform with restaurant management, customer ordering, driver app integration, real-time tracking, and admin dashboard. Need multi-language support (Spanish/English) and integration with local payment providers.',
                'status' => 'contacted',
                'notes' => 'Initial consultation completed. Sending detailed proposal.',
            ],
            [
                'name' => 'James Wilson',
                'email' => 'james@investmentfirm.com',
                'phone' => '+1-555-789-0123',
                'company' => 'Investment Firm LLC',
                'project_type' => 'consultation',
                'budget_range' => '$1,000 - $5,000',
                'message' => 'We have an existing Laravel application that is experiencing performance issues. Looking for a senior developer to audit the codebase, identify bottlenecks, and recommend improvements. The application handles financial data so security is also a concern.',
                'status' => 'in_progress',
                'notes' => 'Code audit in progress. Preliminary findings shared with client.',
            ],
            [
                'name' => 'Lisa Thompson',
                'email' => 'lisa@nonprofitorg.org',
                'phone' => '+1-555-890-1234',
                'company' => 'Nonprofit Organization',
                'project_type' => 'web_application',
                'budget_range' => '$5,000 - $10,000',
                'message' => 'Need a volunteer management system for our nonprofit. Features should include volunteer registration, event scheduling, hour tracking, communication tools, and reporting for grant applications.',
                'status' => 'rejected',
                'notes' => 'Budget constraints. Recommended alternative solutions.',
            ],
            [
                'name' => 'Omar Hassan',
                'email' => 'omar@techconsult.sa',
                'phone' => '+966-50-234-5678',
                'company' => 'Tech Consulting MENA',
                'project_type' => 'api_development',
                'budget_range' => '$10,000 - $25,000',
                'message' => 'Looking to integrate multiple third-party services into our existing platform. Need help building APIs for payment gateways, SMS services, and government verification services specific to the Saudi market.',
                'status' => 'new',
                'notes' => null,
            ],
        ];

        foreach ($quotes as $quote) {
            Quote::updateOrCreate(
                ['email' => $quote['email']],
                $quote
            );
        }
    }
}
