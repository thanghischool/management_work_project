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
        return [
            'workspace_ID' => 16,
            'name' => $this->faker->name,
            'background_image' => $this->faker->imageUrl(),
            'isPublic' => true,
            'index' => $this->faker->numberBetween(1, 10),
            'rate' => $this->faker->numberBetween(1, 100)
        ];
    }
}
