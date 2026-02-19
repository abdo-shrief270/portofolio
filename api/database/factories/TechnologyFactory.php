<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Technology>
 */
class TechnologyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->word();
        return [
            'name' => ucwords($name),
            'slug' => str($name)->slug(),
            'icon' => 'lucide-code',
            'color' => $this->faker->safeHexColor(),
            'category' => $this->faker->randomElement(['frontend', 'backend', 'database', 'devops', 'other']),
            'url' => $this->faker->url(),
        ];
    }
}
