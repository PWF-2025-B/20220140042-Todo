<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), 
            'category_id' => Category::factory(), 
            'title' => ucwords($this->faker->sentence()),
            'is_done' => rand(0, 1),
        ];
    }
}
