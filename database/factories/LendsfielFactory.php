<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\lendsfiel>
 */
class LendsfielFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $date = Carbon::now();
        return [
            'id_scheduleSField'=>$this->faker-> numberBetween($min = 1, $max = 4),
            'id_user'=>$this->faker-> numberBetween($min = 2, $max = 10),
            'id_state'=>1,
            'dateLend'=>$date,
        ];
    }
}
