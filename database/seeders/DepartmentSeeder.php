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
            'name' => 'Muhasebe Muduru',
            'is_multiple' => true
        ]);

        Department::create([
            'name' => 'Pazarlama'
        ])->positions()->create([
            'name' => 'Pazarlama Muduru',
            'is_multiple' => true
        ]);

        Department::create([
            'name' => 'Teknik Servis'
        ])->positions()->create([
            'name' => 'Teknik Servis Muduru',
            'is_multiple' => true
        ]);

        Department::create([
            'name' => 'Insan Kaynaklari'
        ])->positions()->create([
            'name' => 'Insan Kaynaklari Muduru',
            'is_multiple' => true
        ]);
    }
}
