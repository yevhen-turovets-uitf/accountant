<?php

namespace Database\Seeders;

use App\Models\CalendarYear;
use Illuminate\Database\Seeder;

class CalendarYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $years = [2020, 2021, 2022, 2023];
        foreach ($years as $year) {
            CalendarYear::factory()->create([
                'year' => $year,
            ]);
        }
    }
}
