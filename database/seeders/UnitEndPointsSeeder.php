<?php

namespace Database\Seeders;

use App\Models\UnitEndPoints;
use App\Traits\RegCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitEndPointsSeeder extends Seeder
{
    use RegCode;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UnitEndPoints::create([
            "unit_id" => 1,
            "end_point_slug" => "users.index",
            "reg_code" => $this->generateRegCode(UnitEndPoints::class),
        ]);

    }
}
