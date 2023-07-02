<?php

namespace Database\Seeders;

use App\Models\Seat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =
            [
                ['number' => 31],
                ['number' => 32],
                ['number' => 33],
                ['number' => 34],
                ['number' => 35],
                ['number' => 36],
                ['number' => 37],
                ['number' => 38],
                ['number' => 39],
                ['number' => 40]
            ];
        DB::table('seats')->insert($data);
    }
}
