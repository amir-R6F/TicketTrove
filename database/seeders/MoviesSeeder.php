<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Psy\Util\Str;

class MoviesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            [
                'title' => 'Children of heaven',
                'release_year' => '1997.10.01',
                'play_time' => '2018.4.20\22:00:00'
            ],
            [
                'title' => 'About Elly',
                'release_year' => '2009.10.01',
                'play_time' => '2018.4.20\22:00:00'
            ],
            [
                'title' => 'A separation',
                'release_year' => '2011.10.01',
                'play_time' => '2018.4.22\18:00:00'
            ],
            [
                'title' => 'The salesman',
                'release_year' => '2016.10.01',
                'play_time' => '2018.4.21\18:00:00'
            ],
            [
                'title' => 'The Elephant king',
                'release_year' => '2017.10.01',
                'play_time' => '2018.4.21\20:00:00'
            ]
        ];

        DB::table('movies')->insert($data);
    }
}
