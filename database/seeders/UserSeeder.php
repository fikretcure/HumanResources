<?php

namespace Database\Seeders;

use App\Models\User;
use App\Traits\RegCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use RegCode;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Süper",
            "surname" => "Admin",
            "email" => "fikretcure@yandex.com",
            "password" => "Admin-2023",
            "status" => 1,
            "reg_code" => $this->generateRegCode(User::class),
            "role_state" => 1
        ]);
    }
}
