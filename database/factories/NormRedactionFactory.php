<?php

namespace Database\Factories;

use App\Models\NormRedaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class NormRedactionFactory extends Factory
{
    protected $model = NormRedaction::class;

    public function definition()
    {
        $title = $this->faker->unique()->sentence(6);

        return [
            'title' => $title,
            'norm_id' => rand(1, 360),
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'description' => $this->faker->paragraph(60),
        ];
    }
}
