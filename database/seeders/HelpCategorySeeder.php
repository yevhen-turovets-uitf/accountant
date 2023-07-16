<?php

namespace Database\Seeders;

use App\Models\HelpCategory;
use Illuminate\Database\Seeder;

class HelpCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HelpCategory::factory()->create([
            'name' => 'ОБЩАЯ ИНФОРМАЦИЯ',
        ]);

        HelpCategory::factory()->create([
            'name' => 'ПОИСК В БАЗЕ ДАННЫХ',
        ]);
    }
}
