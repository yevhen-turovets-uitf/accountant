<?php

namespace Database\Factories;

use App\Models\Norm;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NormFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Norm::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->unique()->sentence(6);
        $slug = Str::slug($title, '-');
        return [
            'title' => $title,
            'slug' => $slug,
            'number' => rand(1,999),
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'status' => rand(1,4),
        ];
    }
}
