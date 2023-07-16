<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class CalendarWeekendDayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $todayYear = Carbon::now()->format('Y');
        return [
            'date' => fake()->dateTimeBetween('01.01.'.$todayYear, '31.12.'.$todayYear),
        ];
    }
}
