<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'slug' => $this->faker->word,
            'title' => $this->faker->word,
            'excerpt' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
            'category_id' => Category::factory(),
            'user_id' => User::factory()
        ];
    }
}
