<?php

namespace Database\Seeders;

use App\Models\CalendarReport;
use App\Models\Form;
use Illuminate\Database\Seeder;

class CalendarReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $forms = Form::all();

        CalendarReport::factory(100)->create()->each(function ($report) use ($forms) {
            $report->forms()->attach($forms->random(rand(1, 5))->pluck('id')->toArray());
        });
    }
}
