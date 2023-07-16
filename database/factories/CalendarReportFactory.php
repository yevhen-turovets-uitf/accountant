<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class CalendarReportFactory extends Factory
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
            'title' => fake()->words(5, true),
            'description' => fake()->text(),
            'note' => fake()->text(),
            'base' => fake()->text(),
        ];
    }
}
