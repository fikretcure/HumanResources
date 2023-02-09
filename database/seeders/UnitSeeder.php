<?php

namespace Database\Seeders;

use App\Models\Unit;
use App\Traits\RegCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    use RegCode;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Unit::create([
            "name" => "İnsan Kaynakları Departmanı",
            "reg_code" => $this->generateRegCode(Unit::class),
        ]);

        Unit::create([
            "name" => "Muhasebe Departmanı",
            "reg_code" => $this->generateRegCode(Unit::class),
        ]);

        Unit::create([
            "name" => "Muhasebe Müdürü",
            "reg_code" => $this->generateRegCode(Unit::class),
            "parent_id" => 2
        ]);

        Unit::create([
            "name" => "Muhasebe Müdür Yardımcısı",
            "reg_code" => $this->generateRegCode(Unit::class),
            "parent_id" => 2
        ]);
    }
}
