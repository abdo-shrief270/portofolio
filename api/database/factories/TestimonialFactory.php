<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Testimonial>
 */
class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_name' => $this->faker->name(),
            'client_role' => $this->faker->jobTitle(),
            'client_company' => $this->faker->company(),
            'client_avatar' => 'https://i.pravatar.cc/150',
            'content' => $this->faker->paragraph(),
            'rating' => $this->faker->numberBetween(4, 5),
            'is_featured' => $this->faker->boolean(50),
        ];
    }
}
