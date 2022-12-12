<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        \DB::table('sectors')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
   
        \DB::table('sectors')->insert([
            'name'=>'Medio',
            
        ]);
        \DB::table('sectors')->insert([
            'name'=>'Alto',
            
        ]);
    }
}
