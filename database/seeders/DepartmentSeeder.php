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
            'name' => 'Muhasebe',
        ]);

        Department::create([
            'name' => 'Pazarlama',
        ]);

        Department::create([
            'name' => 'Bilisim',
        ]);

        Department::create([
            'name' => 'Insan Kaynaklari',
        ]);
    }
}
