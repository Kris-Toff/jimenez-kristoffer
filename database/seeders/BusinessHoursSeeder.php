<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessHoursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $open_time = strtotime("08:00am");
        $close_time = strtotime("05:00pm");
        $lunch_start = strtotime("12:00pm");
        $lunch_end = strtotime("12:45pm");

        $data = [
            [
                'name' => 'Monday',
                'is_open' => true,
                'open_at' => date("H:i:s", $open_time),
                'close_at' => date("H:i:s", $close_time),
                'lunch_start' => date("H:i:s", $lunch_start),
                'lunch_end' => date("H:i:s", $lunch_end),
                'is_every_other_week' => false,
                'start_date' => null
            ],
            [
                'name' => 'Tuesday',
                'is_open' => false,
                'open_at' => date("H:i:s", $open_time),
                'close_at' => date("H:i:s", $close_time),
                'lunch_start' => date("H:i:s", $lunch_start),
                'lunch_end' => date("H:i:s", $lunch_end),
                'is_every_other_week' => false,
                'start_date' => null
            ],
            [
                'name' => 'Wednesday',
                'is_open' => true,
                'open_at' => date("H:i:s", $open_time),
                'close_at' => date("H:i:s", $close_time),
                'lunch_start' => date("H:i:s", $lunch_start),
                'lunch_end' => date("H:i:s", $lunch_end),
                'is_every_other_week' => false,
                'start_date' => null
            ],
            [
                'name' => 'Thursday',
                'is_open' => false,
                'open_at' => date("H:i:s", $open_time),
                'close_at' => date("H:i:s", $close_time),
                'lunch_start' => date("H:i:s", $lunch_start),
                'lunch_end' => date("H:i:s", $lunch_end),
                'is_every_other_week' => false,
                'start_date' => null
            ],
            [
                'name' => 'Friday',
                'is_open' => true,
                'open_at' => date("H:i:s", $open_time),
                'close_at' => date("H:i:s", $close_time),
                'lunch_start' => date("H:i:s", $lunch_start),
                'lunch_end' => date("H:i:s", $lunch_end),
                'is_every_other_week' => false,
                'start_date' => null
            ],
            [
                'name' => 'Saturday',
                'is_open' => true,
                'open_at' => date("H:i:s", $open_time),
                'close_at' => date("H:i:s", $close_time),
                'lunch_start' => date("H:i:s", $lunch_start),
                'lunch_end' => date("H:i:s", $lunch_end),
                'is_every_other_week' => true,
                'start_date' => null
            ],
            [
                'name' => 'Sunday',
                'is_open' => false,
                'open_at' => date("H:i:s", $open_time),
                'close_at' => date("H:i:s", $close_time),
                'lunch_start' => date("H:i:s", $lunch_start),
                'lunch_end' => date("H:i:s", $lunch_end),
                'is_every_other_week' => false,
                'start_date' => null
            ]
        ];
        DB::table('business_hours')->insert($data);
    }
}
