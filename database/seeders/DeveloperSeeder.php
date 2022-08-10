<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Developer;

class DeveloperSeeder extends Seeder
{
    private $developers = [
        [
            "name" => "DEV1",
            "level" => 1,
        ],
        [
            "name" => "DEV2",
            "level" => 2,
        ],
        [
            "name" => "DEV3",
            "level" => 3,
        ],
        [
            "name" => "DEV4",
            "level" => 4,
        ],
        [
            "name" => "DEV5",
            "level" => 5,
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Developer::insert($this->developers);
    }
}

