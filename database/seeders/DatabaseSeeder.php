<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user if not exists
        User::firstOrCreate(
            ['email' => 'dev.abdo.shrief@gmail.com'],
            [
                'name' => 'Abdelrahman Shrief',
                'email' => 'dev.abdo.shrief@gmail.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Run all seeders in correct order (dependencies first)
        $this->call([
            // Settings (no dependencies)
            SettingSeeder::class,

            // Tech stacks (needed by projects)
            TechStackSeeder::class,

            // Independent content seeders
            SkillSeeder::class,
            ServiceSeeder::class,
            TestimonialSeeder::class,

            // Blog (categories first, then posts)
            BlogCategorySeeder::class,
            BlogPostSeeder::class,

            // Projects (depends on tech stacks)
            ProjectSeeder::class,

            // Quote requests
            QuoteSeeder::class,
        ]);
    }
}
