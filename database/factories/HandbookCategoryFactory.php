<?php

namespace Database\Factories;

use App\Models\HandbookCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class HandbookCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HandbookCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->sentence(6);
        $slug = Str::slug($name, '-');
        return [
            'name' => $name,
            'slug' => $slug,
        ];
    }
}
