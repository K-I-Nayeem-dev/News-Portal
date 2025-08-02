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
            ['id' => 6, 'name' => 'Farhana Rahman', 'email' => 'farhana6@example.com'],
            ['id' => 7, 'name' => 'Tareq Hasan', 'email' => 'tareq7@example.com'],
            ['id' => 8, 'name' => 'Nadia Akter', 'email' => 'nadia8@example.com'],
            ['id' => 9, 'name' => 'Asif Hossain', 'email' => 'asif9@example.com'],
            ['id' => 10, 'name' => 'Sharmin Nahar', 'email' => 'sharmin10@example.com'],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('password123'), // all users use this default password
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}