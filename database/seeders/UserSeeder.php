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
            'password' => 'Karinca-123',
            'status' => true,
        ])->syncRoles(['super_admin']);


        User::create([
            'name' => 'Ataullah',
            'surname' => 'Turgut',
            'phone' => '5050687162',
            'email' => 'career@fikretcure.dev',
            'password' => 'Karinca-123',
            'status' => true,
        ])->syncRoles(['hr_admin']);

    }
}
