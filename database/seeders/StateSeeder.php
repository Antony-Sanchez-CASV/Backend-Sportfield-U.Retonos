<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        \DB::table('states')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        $states=['Activo','Inactivo','Pasado','Ocupado'];
        for($i=0 ; $i<4 ; $i++)
        {
            \DB::table('states')->insert([
                'name'=>$states[$i],
            ]);
        }
    }
}
