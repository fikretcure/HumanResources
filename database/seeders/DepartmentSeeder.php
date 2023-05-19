<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create([
            'name' => 'Muhasebe'
        ])->positions()->create([
            'name' => 'Muhasebe Muduru'
        ]);


        Department::create([
            'name' => 'Pazarlama'
        ])->positions()->create([
            'name' => 'Pazarlama Muduru'
        ]);

        Department::create([
            'name' => 'Teknik Servis'
        ])->positions()->create([
            'name' => 'Teknik Servis Muduru'
        ]);
    }
}
