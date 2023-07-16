<?php

namespace Database\Seeders;

use App\Models\Norm;
use App\Models\NormCategory;
use App\Models\NormRedaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NormSeeder extends Seeder
{
    public function run()
    {
        DB::table('norms')->delete();
        DB::table('norm_categories')->delete();
        DB::table('norm_redactions')->delete();

        if(Env::get('DB_CONNECTION') == 'mysql') {
            DB::statement('ALTER TABLE norms AUTO_INCREMENT = 1');
            DB::statement('ALTER TABLE norm_categories AUTO_INCREMENT = 1');
            DB::statement('ALTER TABLE norm_redactions AUTO_INCREMENT = 1');
        } elseif (Env::get('DB_CONNECTION') == 'pgsql') {
            DB::statement('ALTER SEQUENCE norms_id_seq RESTART WITH 1');
            DB::statement('ALTER SEQUENCE norm_categories_id_seq RESTART WITH 1');
            DB::statement('ALTER SEQUENCE norm_redactions_id_seq RESTART WITH 1');
        } elseif (Env::get('DB_CONNECTION') == 'sqlite') {
            DB::insert('insert into sqlite_sequence (name, seq) values (?, ?)', ['norms', 1]);
            DB::insert('insert into sqlite_sequence (name, seq) values (?, ?)', ['norm_categories', 1]);
            DB::insert('insert into sqlite_sequence (name, seq) values (?, ?)', ['norm_redactions', 1]);
        }

        DB::table('norm_categories')->insert([
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
        $normsOffset = 0;
        $normsLimit = 2;

        Norm::factory(360)->create();
        NormCategory::factory(180)->create();
        NormRedaction::factory(450)->create();

        for ($i = 1; $i <= 6; $i++) {
            $categories = NormCategory::offset($categoriesOffset)->limit($categoriesLimit)->get();

            foreach ($categories as $category) {
                $category->category_id = $i;
                $category->update();

                $normsCollection = Norm::offset($normsOffset)->limit($normsLimit)->get();
                $category->childrenElements()->saveMany($normsCollection);

                $normsOffset += $normsLimit;
                $categoriesOffset += $categoriesLimit;

                $subCategories = NormCategory::offset($categoriesOffset)->limit($categoriesLimit)->get();

                foreach ($subCategories as $subCategory) {
                    $subCategory->category_id = $category->id;
                    $subCategory->update();

                    $normsCollection = Norm::offset($normsOffset)->limit($normsLimit)->get();
                    $subCategory->childrenElements()->saveMany($normsCollection);
                    $normsOffset += $normsLimit;
                }
            }

            $categoriesOffset += $categoriesLimit;
        }
    }
}
