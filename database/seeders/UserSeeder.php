<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'dbu bienestar',
            'email' =>'dbu@unap.edu.pe',
            'password' => bcrypt('12345678'),
        ])->assignRole('Admin');

        User::create([
            'name' => 'almacen bienestar',
            'email' =>'almacen@unap.edu.pe',
            'password' => bcrypt('12345678'),
        ])->assignRole('Almacen');

        User::create([
            'name' => 'nutricion bienestar',
            'email' =>'nutricion@unap.edu.pe',
            'password' => bcrypt('12345678'),
        ])->assignRole('Nutricion');

        // User::factory(9)->create();
    }
}
