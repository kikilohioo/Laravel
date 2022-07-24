<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'names' => $this->faker->name(),
            'lastnames' => $this->faker->name(),
            'email' => $this->faker->email(),
            'DNI' => $this->faker->numberBetween(1000000,99999999),
            'DNI_type' => $this->faker->randomElement(['CI','Pasaporte']),
            'phone' => $this->faker->phoneNumber(),
            'gender' => $this->faker->randomElement(['Hombre','Mujer','No Binario']),
            'password' => Hash::make($this->faker->password(6,20))
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
