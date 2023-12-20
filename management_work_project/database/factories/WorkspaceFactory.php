<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Workspace;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Workspace>
 */
class WorkspaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Workspace::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'avatar' => $this->faker->imageUrl(),
            'admin_ID' => 2,
            'isPublic' => true
        ];
    }
}
