<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        \DB::table('schedules')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        $day=1;
        $hour=1;
        $hour_actual=7;
        while($day<=7){
            for ($i=0; $i<13; $i++){
                
                \DB::table('schedules')->insert([
                    'id_day'=>$day,
                    'startT'=>Carbon::createFromTime($hour_actual+$i,0,0,'GMT'),
                    'finishT'=>Carbon::createFromTime($hour_actual+$i+$hour,0,0,'GMT'),
                    'hours'=>$hour,
                ]);             
            } 
            $day++;
        }    
            
        
    }
}
