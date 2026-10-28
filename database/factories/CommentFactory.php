<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'content' => fake()->paragraph(),
            'rating' => fake()->numberBetween(1, 10),
            'recipe_id' => Recipe::factory(),
            'user_id' => User::factory(),
        ];
    }
}
