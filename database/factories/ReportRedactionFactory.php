<?php

namespace Database\Factories;

use App\Models\ReportRedaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReportRedactionFactory extends Factory
{
    protected $model = ReportRedaction::class;

    public function definition()
    {
        $title = $this->faker->unique()->sentence(6);

        return [
            'title' => $title,
            'report_id' => rand(1, 360),
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'description' => $this->faker->paragraph(60),
        ];
    }
}
