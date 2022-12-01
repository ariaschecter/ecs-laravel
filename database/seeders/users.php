<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'adminmanusia@gmail.com',
            'user_picture' => '',
            'user_city' => 'Semarang',
            'user_age' => 20,
            'password' => Hash::make('admin123'),
            'role_id' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'agung',
            'email' => 'agung9@gmail.com',
            'user_picture' => '',
            'user_city' => 'Brebes',
            'user_age' => 20,
            'password' => Hash::make('123456'),
            'role_id' => 2,
        ]);
    }
}
