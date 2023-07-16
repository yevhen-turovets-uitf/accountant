<?php

namespace Database\Seeders;

use App\Models\Blank;
use App\Models\BlankCategory;
use App\Models\BlankRedaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlankSeeder extends Seeder
{
    public function run()
    {
        DB::table('blanks')->delete();
        DB::table('blank_categories')->delete();
        DB::table('blank_redactions')->delete();

        if(Env::get('DB_CONNECTION') == 'mysql') {
            DB::statement('ALTER TABLE blanks AUTO_INCREMENT = 1');
            DB::statement('ALTER TABLE blank_categories AUTO_INCREMENT = 1');
            DB::statement('ALTER TABLE blank_redactions AUTO_INCREMENT = 1');
        } elseif (Env::get('DB_CONNECTION') == 'pgsql') {
            DB::statement('ALTER SEQUENCE blanks_id_seq RESTART WITH 1');
            DB::statement('ALTER SEQUENCE blank_categories_id_seq RESTART WITH 1');
            DB::statement('ALTER SEQUENCE blank_redactions_id_seq RESTART WITH 1');
        } elseif (Env::get('DB_CONNECTION') == 'sqlite') {
            DB::insert('insert into sqlite_sequence (name, seq) values (?, ?)', ['blanks', 1]);
            DB::insert('insert into sqlite_sequence (name, seq) values (?, ?)', ['blank_categories', 1]);
            DB::insert('insert into sqlite_sequence (name, seq) values (?, ?)', ['blank_redactions', 1]);
        }

        DB::table('blank_categories')->insert([
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
        $blanksOffset = 0;
        $blanksLimit = 2;

        Blank::factory(360)->create();
        BlankCategory::factory(180)->create();
        BlankRedaction::factory(450)->create();

        for ($i = 1; $i <= 6; $i++) {
            $categories = BlankCategory::offset($categoriesOffset)->limit($categoriesLimit)->get();

            foreach ($categories as $category) {
                $category->category_id = $i;
                $category->update();

                $blanksCollection = Blank::offset($blanksOffset)->limit($blanksLimit)->get();
                $category->childrenElements()->saveMany($blanksCollection);

                $blanksOffset += $blanksLimit;
                $categoriesOffset += $categoriesLimit;

                $subCategories = BlankCategory::offset($categoriesOffset)->limit($categoriesLimit)->get();

                foreach ($subCategories as $subCategory) {
                    $subCategory->category_id = $category->id;
                    $subCategory->update();

                    $blanksCollection = Blank::offset($blanksOffset)->limit($blanksLimit)->get();
                    $subCategory->childrenElements()->saveMany($blanksCollection);
                    $blanksOffset += $blanksLimit;
                }
            }

            $categoriesOffset += $categoriesLimit;
        }
    }
}
