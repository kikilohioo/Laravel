<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Championship>
 */
class ChampionshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->paragraph(2),
            'id_user' => $this->faker->numberBetween(1,5),
            'departament' => $this->faker->randomElement(['Artigas','Canelones','Colonia','Cerro Largo','Chuy', 'Durazno', 'Flores', 'Florida', 'Lavalleja', 'Rivera', 'Montevideo', 'Maldonado', 'Salto', 'Soriano', 'Paysandu', 'Tacuarembo', 'Treinta y Tres', 'Rio Negro', 'San José']),
            'city' => $this->faker->name(),
            'direction' => $this->faker->address(),
            'cash' => $this->faker->boolean(),
            'transfer' => $this->faker->boolean(),
            'online' => $this->faker->boolean(),
            'abitab_redpagos' => $this->faker->boolean(),
            'beach' => $this->faker->boolean(),
            'max_teams' => $this->faker->numberBetween(1,100),
            'datetime' => $this->faker->dateTime(),
            'group_stage' => $this->faker->boolean(),
            'competition_format' => $this->faker->name(),
            'sets' => $this->faker->numberBetween(1,5),
            'final_sets' => $this->faker->numberBetween(1,5),
            'points' => $this->faker->numberBetween(1,25),
            'final_points' => $this->faker->numberBetween(1,25),
            'gold_cup' => $this->faker->boolean(),
            'silver_cup' => $this->faker->boolean(),
            'bronce_cup' => $this->faker->boolean(),
            'participation_reward' => $this->faker->boolean(),
            'gender' => $this->faker->randomElement(['MAS','FEM','MIX'])
        ];
    }
}
