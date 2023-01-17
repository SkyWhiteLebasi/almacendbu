<?php

namespace Database\Seeders;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::create([
        //     'name' => 'bienestar',
        //     'email' =>'dbu@unap.edu.pe',
        //     'password' => bcrypt('12345678'),
        // ])->assignRole('Admin');
        
        $this->call(RoleSeeder::class);

        $this->call(UserSeeder::class);
    }
}
