<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vcourse;


class VcourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        \DB::table('vcourses')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        Vcourse::factory()->count(7)->create();
    }
}
