<?php

namespace Database\Seeders;

use App\Models\TaxSystem;
use App\Models\TaxSystemCategory;
use App\Models\TaxSystemRedaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TaxSystemSeeder extends Seeder
{
    public function run()
    {
        DB::table('tax_systems')->delete();
        DB::table('tax_system_categories')->delete();
        DB::table('tax_system_redactions')->delete();

        if(Env::get('DB_CONNECTION') == 'mysql') {
            DB::statement('ALTER TABLE tax_systems AUTO_INCREMENT = 1');
            DB::statement('ALTER TABLE tax_system_categories AUTO_INCREMENT = 1');
            DB::statement('ALTER TABLE tax_system_redactions AUTO_INCREMENT = 1');
        } elseif (Env::get('DB_CONNECTION') == 'pgsql') {
            DB::statement('ALTER SEQUENCE tax_systems_id_seq RESTART WITH 1');
            DB::statement('ALTER SEQUENCE tax_system_categories_id_seq RESTART WITH 1');
            DB::statement('ALTER SEQUENCE tax_system_redactions_id_seq RESTART WITH 1');
        } elseif (Env::get('DB_CONNECTION') == 'sqlite') {
            DB::insert('insert into sqlite_sequence (name, seq) values (?, ?)', ['tax_systems', 1]);
            DB::insert('insert into sqlite_sequence (name, seq) values (?, ?)', ['tax_system_categories', 1]);
            DB::insert('insert into sqlite_sequence (name, seq) values (?, ?)', ['tax_system_redactions', 1]);
        }

        DB::table('tax_system_categories')->insert([
            [
                'name' => 'Нормативная база',
                'slug' => Str::slug('Нормативная база'),
                'category_id' => null,
            ],
            [
                'name' => 'Отчётность',
                'slug' => Str::slug('Отчётность'),
                'category_id' => null,
            ],
            [
                'name' => 'Налоговая система',
                'slug' => Str::slug('Налоговая система'),
                'category_id' => null,
            ],
            [
                'name' => 'Консультации и аналитика',
                'slug' => Str::slug('Консультации и аналитика'),
                'category_id' => null,
            ],
            [
                'name' => 'Формы и бланки',
                'slug' => Str::slug('Формы и бланки'),
                'category_id' => null,
            ],
            [
                'name' => 'Справочники',
                'slug' => Str::slug('Справочники'),
                'category_id' => null,
            ],
        ]);
        $categoriesOffset = 6;
        $categoriesLimit = 5;
        $taxSystemsOffset = 0;
        $taxSystemsLimit = 2;

        TaxSystem::factory(360)->create();
        TaxSystemCategory::factory(180)->create();
        TaxSystemRedaction::factory(450)->create();

        for ($i = 1; $i <= 6; $i++) {
            $categories = TaxSystemCategory::offset($categoriesOffset)->limit($categoriesLimit)->get();

            foreach ($categories as $category) {
                $category->category_id = $i;
                $category->update();

                $taxSystemsCollection = TaxSystem::offset($taxSystemsOffset)->limit($taxSystemsLimit)->get();
                $category->childrenElements()->saveMany($taxSystemsCollection);

                $taxSystemsOffset += $taxSystemsLimit;
                $categoriesOffset += $categoriesLimit;

                $subCategories = TaxSystemCategory::offset($categoriesOffset)->limit($categoriesLimit)->get();

                foreach ($subCategories as $subCategory) {
                    $subCategory->category_id = $category->id;
                    $subCategory->update();

                    $taxSystemsCollection = TaxSystem::offset($taxSystemsOffset)->limit($taxSystemsLimit)->get();
                    $subCategory->childrenElements()->saveMany($taxSystemsCollection);
                    $taxSystemsOffset += $taxSystemsLimit;
                }
            }

            $categoriesOffset += $categoriesLimit;
        }
    }
}
