<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'title' => $this->faker->unique()->sentence(),
            'body' => $this->faker->text(),
            'image_path' => $this->faker->imageUrl(640, 480),
            'is_published' => 1,
            'time_to_read' => $this->faker->numberBetween(1, 10),
            'priority' => $this->faker->numberBetween(1, 5),
        ];
    }
}
