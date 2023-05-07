<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super',
            'surname' => 'Admin',
            'phone' => '5050687161',
            'email' => 'fikretcure@gmail.com',
            'password' => 123123,
            'status' => true,
        ]);
    }
}
