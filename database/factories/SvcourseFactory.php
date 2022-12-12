<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Svcourse>
 */
class SvcourseFactory extends Factory
{
    use HasFactory;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id_vcourse'=>$this->faker-> numberBetween($min = 1, $max = 7),
            'id_schedule'=>$this->faker-> numberBetween($min = 1, $max = 12),
        ];
    }
}
