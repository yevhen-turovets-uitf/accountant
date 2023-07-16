<?php

namespace Database\Factories;

use App\Models\PublishedOnSite;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PublishedOnSiteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PublishedOnSite::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->unique()->sentence(6);
        $slug = Str::slug($title, '-');
        $date = $this->faker->dateTimeBetween('-1 year', 'now');
        return [
            'date' => $date,
            'title' => $title,
            'url' => '/' . $slug,
        ];
    }
}
