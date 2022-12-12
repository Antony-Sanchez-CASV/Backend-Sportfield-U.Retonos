<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Database\Seeders\UserSeeder;
use Database\Seeders\RolSeeder;
use Database\Seeders\DaySeeder;
//use Database\Seeders\HourSeeder;
use Database\Seeders\SectorSeeder;
use Database\Seeders\ActivitySeeder;
use Database\Seeders\RoomSeeder;
use Database\Seeders\InstructorSeeder;

use Database\Seeders\StateSeeder;
use Database\Seeders\ScheduleSeeder;
use Database\Seeders\SsfieldSeeder;
use Database\Seeders\SvcourseSeeder;
use Database\Seeders\LendsfielSeeder;
use Database\Seeders\SubsvcourseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([RolSeeder::class]);
        $this->call([DaySeeder::class]);
        //$this->call([HourSeeder::class]);
        $this->call([SectorSeeder::class]);
        $this->call([ActivitySeeder::class]);
        $this->call([InstructorSeeder::class]);

        $this->call([StateSeeder::class]);
        $this->call([RoomSeeder::class]);
        $this->call([ScheduleSeeder::class]);
        $this->call([UserSeeder::class]);
        $this->call([SFieldSeeder::class]);
        $this->call([VcourseSeeder::class]);
        $this->call([SvcourseSeeder::class]);
        $this->call([SsfieldSeeder::class]);
        $this->call([LendsfielSeeder::class]);
        $this->call([SubsvcourseSeeder::class]);

    }
}
