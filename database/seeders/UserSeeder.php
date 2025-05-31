<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Admin', 'email' => 'admin@example.com', 'password' => Hash::make('123456'), 'role' => 'admin'],
            ['name' => 'User', 'email' => 'user@example.com', 'password' => Hash::make('123456'), 'role' => 'user'],
        ];

        DB::table('users')->insert($users);
    }
}
