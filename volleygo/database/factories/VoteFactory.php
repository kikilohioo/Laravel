<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vote>
 */
class VoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_user' => 1,
            'id_championship' => 2,
            'id_tp_cen1' => 3,
            'id_tp_cen2' => 4,
            'id_tp_ops1' => 5,
            'id_tp_ops2' => 6,
            'id_tp_set' => 7,
            'id_tp_lib' => 8,
            'id_tp_opo' => 9
        ];
    }
}
