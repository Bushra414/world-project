<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Sultan',
            'email' => 'sultanki27@gmail.com',
            'password' => Hash::make('sultan27'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

