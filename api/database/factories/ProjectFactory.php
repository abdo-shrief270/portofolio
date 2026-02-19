<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->unique()->sentence(3);
        return [
            'title' => $title,
            'slug' => str($title)->slug(),
            'subtitle' => $this->faker->sentence(),
            'description' => $this->faker->paragraphs(3, true),
            'short_description' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['live', 'in_progress', 'completed', 'archived']),
            'is_featured' => $this->faker->boolean(20),
            'demo_url' => $this->faker->url(),
            'github_url' => $this->faker->url(),
            'thumbnail' => 'https://placehold.co/600x400',
            'gallery' => [
                'https://placehold.co/600x400',
                'https://placehold.co/600x400',
            ],
            'tech_stack' => ['Laravel', 'Next.js', 'Tailwind'],
            'features' => [
                ['title' => 'Feature 1', 'description' => 'Desc 1', 'icon' => 'lucide-star'],
                ['title' => 'Feature 2', 'description' => 'Desc 2', 'icon' => 'lucide-zap'],
            ],
            'seo_title' => $title,
            'seo_description' => $this->faker->sentence(),
            'seo_keywords' => ['portfolio', 'laravel', 'nextjs'],
            'sort_order' => $this->faker->numberBetween(1, 100),
            'published_at' => now(),
        ];
    }
}
