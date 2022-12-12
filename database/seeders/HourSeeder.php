<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Carbon\Carbon;
class HourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        \DB::table('hours')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        $iA=7;
        $hour=1;
        for ($i=0; $i<13; $i++){
            \DB::table('hours')->insert([
                'startT'=>Carbon::createFromTime($iA+$i,0,0,'GMT'),
                'finishT'=>Carbon::createFromTime($iA+$hour+$i,0,0,'GMT'),
                'hours'=>$hour,
            ]);
        }
        $hour++;
        for ($i=0; $i<12; $i+=2){
            \DB::table('hours')->insert([
                'startT'=>Carbon::createFromTime($iA+$i,0,0,'GMT'),
                'finishT'=>Carbon::createFromTime($iA+$hour+$i,0,0,'GMT'),
                'hours'=>$hour,
            ]);
        }
        $hour++;
        for ($i=0; $i<11; $i+=3){
            \DB::table('hours')->insert([
                'startT'=>Carbon::createFromTime($iA+$i,0,0,'GMT'),
                'finishT'=>Carbon::createFromTime($iA+$hour+$i,0,0,'GMT'),
                'hours'=>$hour,
            ]);
        }
    }
}
