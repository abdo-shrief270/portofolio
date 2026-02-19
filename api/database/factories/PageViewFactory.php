<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PageView>
 */
class PageViewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'page' => $this->faker->randomElement(['home', 'projects', 'about', 'contact']),
            'ip_hash' => hash('sha256', $this->faker->ipv4()),
            'referrer' => $this->faker->url(),
            'user_agent' => $this->faker->userAgent(),
            'country' => $this->faker->countryCode(),
        ];
    }
}
