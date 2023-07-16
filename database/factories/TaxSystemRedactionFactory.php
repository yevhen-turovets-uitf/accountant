<?php

namespace Database\Factories;

use App\Models\TaxSystemRedaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaxSystemRedactionFactory extends Factory
{
    protected $model = TaxSystemRedaction::class;

    public function definition()
    {
        $title = $this->faker->unique()->sentence(6);

        return [
            'title' => $title,
            'tax_system_id' => rand(1, 360),
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'description' => $this->faker->paragraph(60),
        ];
    }
}
