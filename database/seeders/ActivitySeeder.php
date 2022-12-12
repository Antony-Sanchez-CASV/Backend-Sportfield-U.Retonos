<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        \DB::table('activities')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
   
        \DB::table('activities')->insert([
            'name'=>'fútbol',
        ]);
        \DB::table('activities')->insert([
            'name'=>'basquet',
        ]);
        \DB::table('activities')->insert([
            'name'=>'voley',
        ]);
        \DB::table('activities')->insert([
            'name'=>'tenis',
        ]);
        \DB::table('activities')->insert([
            'name'=>'deportes',
        ]);
    }
}
