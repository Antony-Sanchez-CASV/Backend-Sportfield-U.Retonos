<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        \DB::table('rols')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        $rols = ['admin','denizen'];

        for($i=0 ; $i<2 ; $i++)
        {
            \DB::table('rols')->insert([
                'name'=>$rols[$i]
            ]);
        }
    }
}
