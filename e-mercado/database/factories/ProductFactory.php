<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name(),
            'description' => $this->faker->words(20, true),
            'price' => $this->faker->numberBetween(1, 10000),
            'stock' => $this->faker->numberBetween(0, 100),
            'status' => $this->faker->randomElement(['available', 'unavailable'])
        ];
    }
}
