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
            "name" => "İnsan Kaynakları",
            "reg_code" => $this->generateRegCode(Unit::class),
        ]);

        Unit::create([
            "name" => "Muhasebe",
            "reg_code" => $this->generateRegCode(Unit::class),
        ]);
    }
}
