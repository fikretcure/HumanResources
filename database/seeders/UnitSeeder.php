<?php

namespace Database\Seeders;

use App\Enums\UnitTypeEnum;
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
            "name" => "İnsan Kaynakları",
            "reg_code" => $this->generateRegCode(Unit::class),
            "type" => UnitTypeEnum::DEPARTMENT->value
        ]);

        Unit::create([
            "name" => "Muhasebe",
            "reg_code" => $this->generateRegCode(Unit::class),
            "type" => UnitTypeEnum::DEPARTMENT->value
        ]);

        Unit::create([
            "name" => "Muhasebe Müdürü",
            "reg_code" => $this->generateRegCode(Unit::class),
            "parent_id" => 2,
            "type" => UnitTypeEnum::POSITION->value
        ]);

        Unit::create([
            "name" => "Muhasebe Müdür Yardımcısı",
            "reg_code" => $this->generateRegCode(Unit::class),
            "parent_id" => 3,
            "type" => UnitTypeEnum::POSITION->value
        ]);

        Unit::create([
            "name" => "İnsan Kaynakları Müdürü",
            "reg_code" => $this->generateRegCode(Unit::class),
            "parent_id" => 1,
            "type" => UnitTypeEnum::POSITION->value
        ]);
    }
}
