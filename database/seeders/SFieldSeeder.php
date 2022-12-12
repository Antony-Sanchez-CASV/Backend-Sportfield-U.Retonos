<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SField;


class SFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        \DB::table('s_fields')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        SField::factory()->count(4)->create();

    }
}
