<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SField>
 */
class SFieldFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $id=$this->faker-> numberBetween($min = 0, $max = 3);
        $nameElement=['B', 'V', 'F','T'];
        $name= $nameElement[$id];//+str($id);
        return [
            'name'=>$name,
            'id_sector'=>$this->faker-> numberBetween($min = 1, $max = 2),
            'id_activity'=>$id+1,

        ];
    }
}
