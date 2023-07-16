<?php

namespace Database\Seeders;

use App\Models\HelpElement;
use Illuminate\Database\Seeder;

class HelpElementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HelpElement::factory()->create([
            'name' => 'Технические требования',
            'slug' => 'tehnicheskie-trebovaniya',
            'help_category_id' => 1,
        ]);

        HelpElement::factory()->create([
            'name' => 'Регистрация в системе',
            'slug' => 'registratsiya-v-sisteme',
            'help_category_id' => 1,
        ]);

        HelpElement::factory()->create([
            'name' => 'Поисковая система',
            'slug' => 'poiskovaya-sistema',
            'help_category_id' => 2,
        ]);

        HelpElement::factory()->create([
            'name' => 'Поиск по тематике',
            'slug' => 'poisk-po-tematike',
            'help_category_id' => 2,
        ]);

        HelpElement::factory()->create([
            'name' => 'Поиск по ключевым словам',
            'slug' => 'poisk-po-klyuchevyim-slovam',
            'help_category_id' => 2,
        ]);

        HelpElement::factory()->create([
            'name' => 'Поиск по реквизитам',
            'slug' => 'poisk-po-rekvizitam',
            'help_category_id' => 2,
        ]);

        HelpElement::factory()->create([
            'name' => 'Новые документы',
            'slug' => 'novyie-dokumentyi',
            'help_category_id' => 2,
        ]);
    }
}
