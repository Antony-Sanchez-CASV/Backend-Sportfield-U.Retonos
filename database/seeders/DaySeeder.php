<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        \DB::table('days')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        \DB::table('days')->insert(['name'=>'Lunes']);
        \DB::table('days')->insert(['name'=>'Martes']);
        \DB::table('days')->insert(['name'=>'Miercoles']);
        \DB::table('days')->insert(['name'=>'Jueves']);
        \DB::table('days')->insert(['name'=>'Viernes' ]);
        \DB::table('days')->insert(['name'=>'Sabado']);
        \DB::table('days')->insert(['name'=>'Domingo']);
    }
}
