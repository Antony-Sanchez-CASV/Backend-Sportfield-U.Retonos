<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Instructor>
 */
class InstructorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstname(),
            'latName' => $this->faker->lastname(),
            'collegeDegree' => 'Universidad',
            'salary' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 999),
            'address' => $this->faker->streetAddress,
            'cellphone' => '09' . $this->faker->randomNumber(8),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
