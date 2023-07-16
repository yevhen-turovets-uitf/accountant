<?php

namespace Database\Factories;

use App\Models\Blank;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlankFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blank::class;

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
            'slug' => $slug
        ];
    }
}
