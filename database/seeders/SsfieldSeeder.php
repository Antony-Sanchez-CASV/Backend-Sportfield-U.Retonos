<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ssfield;


class SsfieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        \DB::table('ssfields')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        for($field=1;$field<5;$field++){
            for($schedule=1;$schedule<92;$schedule++){
                \DB::table('ssfields')->insert([
                    'id_sField'=>$field,
                    'id_schedule'=>$schedule,
                ]);
            }   
        }
    }
}
