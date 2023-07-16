<?php

namespace Database\Factories;

use App\Models\ConsultationRedaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConsultationRedactionFactory extends Factory
{
    protected $model = ConsultationRedaction::class;

    public function definition()
    {
        $title = $this->faker->unique()->sentence(6);

        return [
            'title' => $title,
            'consultation_id' => rand(1, 360),
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'description' => $this->faker->paragraph(60),
        ];
    }
}
