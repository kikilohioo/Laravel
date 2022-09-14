<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'path' => 'img/products/'.$this->faker->numberBetween(1,10).'.jpg'
        ];
    }

    public function user()
    {
        return $this->state([
            'path' => 'img/users/'.$this->faker->numberBetween(1,10).'.jpg'
        ]);
    }
}
