<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vcourse>
 */
class VcourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'=>$this->faker-> name(),
            'description'=>$this->faker-> text(),
            'id_instructor'=>$this->faker-> numberBetween($min = 1, $max = 10),
            'id_room'=>$this->faker-> numberBetween($min = 1, $max = 5),
            'capacity'=>$this->faker-> numberBetween($min = 1, $max = 50),
            'taken'=>0,
            'duration_week'=>$this->faker-> numberBetween($min = 1, $max = 20),


        ];
    }
}
