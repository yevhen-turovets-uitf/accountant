<?php

namespace Database\Seeders;

use App\Models\Handbook;
use App\Models\HandbookCategory;
use App\Models\HandbookRedaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HandbookSeeder extends Seeder
{
    public function run()
    {
        DB::table('handbooks')->delete();
        DB::table('handbook_categories')->delete();
        DB::table('handbook_redactions')->delete();

        if(Env::get('DB_CONNECTION') == 'mysql') {
            DB::statement('ALTER TABLE handbooks AUTO_INCREMENT = 1');
            DB::statement('ALTER TABLE handbook_categories AUTO_INCREMENT = 1');
            DB::statement('ALTER TABLE handbook_redactions AUTO_INCREMENT = 1');
        } elseif (Env::get('DB_CONNECTION') == 'pgsql') {
            DB::statement('ALTER SEQUENCE handbooks_id_seq RESTART WITH 1');
            DB::statement('ALTER SEQUENCE handbook_categories_id_seq RESTART WITH 1');
            DB::statement('ALTER SEQUENCE handbook_redactions_id_seq RESTART WITH 1');
        } elseif (Env::get('DB_CONNECTION') == 'sqlite') {
            DB::insert('insert into sqlite_sequence (name, seq) values (?, ?)', ['handbooks', 1]);
            DB::insert('insert into sqlite_sequence (name, seq) values (?, ?)', ['handbook_categories', 1]);
            DB::insert('insert into sqlite_sequence (name, seq) values (?, ?)', ['handbook_redactions', 1]);
        }

        DB::table('handbook_categories')->insert([
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
        $handbooksOffset = 0;
        $handbooksLimit = 2;

        Handbook::factory(360)->create();
        HandbookCategory::factory(180)->create();
        HandbookRedaction::factory(450)->create();

        for ($i = 1; $i <= 6; $i++) {
            $categories = HandbookCategory::offset($categoriesOffset)->limit($categoriesLimit)->get();

            foreach ($categories as $category) {
                $category->category_id = $i;
                $category->update();

                $handbooksCollection = Handbook::offset($handbooksOffset)->limit($handbooksLimit)->get();
                $category->childrenElements()->saveMany($handbooksCollection);

                $handbooksOffset += $handbooksLimit;
                $categoriesOffset += $categoriesLimit;

                $subCategories = HandbookCategory::offset($categoriesOffset)->limit($categoriesLimit)->get();

                foreach ($subCategories as $subCategory) {
                    $subCategory->category_id = $category->id;
                    $subCategory->update();

                    $handbooksCollection = Handbook::offset($handbooksOffset)->limit($handbooksLimit)->get();
                    $subCategory->childrenElements()->saveMany($handbooksCollection);
                    $handbooksOffset += $handbooksLimit;
                }
            }

            $categoriesOffset += $categoriesLimit;
        }
    }
}
