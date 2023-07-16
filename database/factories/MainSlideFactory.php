<?php

namespace Database\Factories;

use App\Models\MainSlide;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MainSlideFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MainSlide::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->unique()->sentence(3);
        $slug = Str::slug($title, '-');
        return [
            'title' => $title,
            'link' => '/' . $slug,
            'description' => $this->faker->unique()->sentence(10),
            'position' => rand(1,100),
        ];
    }
}
