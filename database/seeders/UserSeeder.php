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
            "name" => "Fikret",
            "surname" => "Cüre",
            "email" => "fikretcure@gmail.com",
            "password" => "123456",
            "status" => "active",
            "reg_code" => $this->generateRegCode(User::class),
            "role_state" => 1
        ]);
    }
}
