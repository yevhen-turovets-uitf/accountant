<?php

namespace Database\Factories;

use App\Models\BlankRedaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlankRedactionFactory extends Factory
{
    protected $model = BlankRedaction::class;

    public function definition()
    {
        $title = $this->faker->unique()->sentence(6);

        return [
            'title' => $title,
            'blank_id' => rand(1, 360),
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'description' => $this->faker->paragraph(60),
        ];
    }
}
