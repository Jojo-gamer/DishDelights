<?php

namespace Database\Factories;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Recipe>
 */
class RecipeFactory extends Factory
{
    protected $model = Recipe::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(3, true),
            'description' => fake()->paragraph(),
            'prep_time' => fake()->numberBetween(10, 90),
            'instructions' => json_encode(fake()->sentences(5)),
            'image_path' => 'recipes/7xbPjhBjIC9DUQZK2VymD9xRUYY69cvOztTjUNho.webp',
            'status' => 'pending',
            'is_active' => true,
            'user_id' => User::factory(),
        ];
    }
}
