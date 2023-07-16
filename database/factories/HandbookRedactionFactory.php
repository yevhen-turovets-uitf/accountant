<?php

namespace Database\Factories;

use App\Models\HandbookRedaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class HandbookRedactionFactory extends Factory
{
    protected $model = HandbookRedaction::class;

    public function definition()
    {
        $title = $this->faker->unique()->sentence(6);

        return [
            'title' => $title,
            'handbook_id' => rand(1, 360),
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'description' => $this->faker->paragraph(60),
        ];
    }
}
