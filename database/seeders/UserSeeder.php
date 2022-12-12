<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


use App\Models\User;
use App\Models\Rol;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        \DB::table('users')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        \DB::table('users')->insert([
            'id_rol'=>1,
            'firstName' => 'Admin',
            'lastName' => 'Admin',
            'nickname' => 'Admin',
            'batch' => 0,
            'cellphone'=>'0000000000',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' =>  Hash::make('admin'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $rol_denizen = Rol::where('name', 'denizen')->first();

        User::factory()->count(10)->create();
    }
}
