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
            'email' => 'info@fikretcure.dev',
            'password' => 'Karinca-123',
            'status' => true,
            'sex' => 'Bay',
            'start_work' => now(),
            'birth_at' => now(),
            'position_id' => 4
        ])->syncRoles(['super_admin']);

        User::create([
            'name' => 'Kadir',
            'surname' => 'Yucel',
            'phone' => '5050687154',
            'email' => 'mail.kadiryucel@gmail.com',
            'password' => 'Karinca-123',
            'status' => true,
            'sex' => 'Bay',
            'start_work' => now(),
            'birth_at' => now(),
            'position_id' => 4
        ])->syncRoles(['super_admin']);

        User::create([
            'name' => 'Merve',
            'surname' => 'Turgut',
            'phone' => '5050687162',
            'email' => 'fikretcure@yandex.com.tr',
            'password' => 'Karinca-123',
            'status' => true,
            'sex' => 'Bayan',
            'start_work' => now(),
            'birth_at' => now(),
            'position_id' => 4
        ])->syncRoles(['hr_admin']);
    }
}
