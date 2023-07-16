<?php

namespace Database\Factories;

use App\Models\HelpElement;
use Illuminate\Database\Eloquent\Factories\Factory;

class HelpElementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HelpElement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->sentence(2),
            'description' => $this->faker->unique()->sentence(10),
            'help_category_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}
