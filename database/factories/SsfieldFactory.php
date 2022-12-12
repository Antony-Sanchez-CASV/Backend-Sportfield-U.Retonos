<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ssfield>
 */
class SsfieldFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_sField'=>$this->faker-> numberBetween($min = 1, $max = 4),
            'id_schedule'=>$this->faker-> numberBetween($min = 1, $max = 161),
        ];
    }
}
