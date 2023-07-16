<?php

namespace Database\Seeders;

use App\Models\CalendarTaxPaymentDay;
use App\Models\CalendarWeekendDay;

use Illuminate\Database\Seeder;

class CalendarDatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $weekendDates = [
            '2023-02-03',
            '2023-03-08',
            '2023-03-10',
            '2023-03-17',
            '2023-04-23',
            '2023-04-21',
        ];
        foreach ($weekendDates as $date) {
            CalendarWeekendDay::factory()->create([
                'date' => $date,
            ]);
        }

        $taxPaymentDays = [
            '2023-03-28',
            '2023-03-29',
            '2023-03-31',
            '2023-04-04',
            '2023-04-05',
            '2023-04-12',
            '2023-04-20',
        ];
        foreach ($taxPaymentDays as $date) {
            CalendarTaxPaymentDay::factory()->create([
                'date' => $date,
            ]);
        }
    }
}
