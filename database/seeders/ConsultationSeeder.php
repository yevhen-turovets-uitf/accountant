<?php

namespace Database\Seeders;

use App\Models\Consultation;
use App\Models\ConsultationCategory;
use App\Models\ConsultationRedaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ConsultationSeeder extends Seeder
{
    public function run()
    {
        DB::table('consultations')->delete();
        DB::table('consultation_categories')->delete();
        DB::table('consultation_redactions')->delete();

        if(Env::get('DB_CONNECTION') == 'mysql') {
            DB::statement('ALTER TABLE consultations AUTO_INCREMENT = 1');
            DB::statement('ALTER TABLE consultation_categories AUTO_INCREMENT = 1');
            DB::statement('ALTER TABLE consultation_redactions AUTO_INCREMENT = 1');
        } elseif (Env::get('DB_CONNECTION') == 'pgsql') {
            DB::statement('ALTER SEQUENCE consultations_id_seq RESTART WITH 1');
            DB::statement('ALTER SEQUENCE consultation_categories_id_seq RESTART WITH 1');
            DB::statement('ALTER SEQUENCE consultation_redactions_id_seq RESTART WITH 1');
        } elseif (Env::get('DB_CONNECTION') == 'sqlite') {
            DB::insert('insert into sqlite_sequence (name, seq) values (?, ?)', ['consultations', 1]);
            DB::insert('insert into sqlite_sequence (name, seq) values (?, ?)', ['consultation_categories', 1]);
            DB::insert('insert into sqlite_sequence (name, seq) values (?, ?)', ['consultation_redactions', 1]);
        }

        DB::table('consultation_categories')->insert([
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
        $consultationsOffset = 0;
        $consultationsLimit = 2;

        Consultation::factory(360)->create();
        ConsultationCategory::factory(180)->create();
        ConsultationRedaction::factory(450)->create();

        for ($i = 1; $i <= 6; $i++) {
            $categories = ConsultationCategory::offset($categoriesOffset)->limit($categoriesLimit)->get();

            foreach ($categories as $category) {
                $category->category_id = $i;
                $category->update();

                $consultationsCollection = Consultation::offset($consultationsOffset)->limit($consultationsLimit)->get();
                $category->childrenElements()->saveMany($consultationsCollection);

                $consultationsOffset += $consultationsLimit;
                $categoriesOffset += $categoriesLimit;

                $subCategories = ConsultationCategory::offset($categoriesOffset)->limit($categoriesLimit)->get();

                foreach ($subCategories as $subCategory) {
                    $subCategory->category_id = $category->id;
                    $subCategory->update();

                    $consultationsCollection = Consultation::offset($consultationsOffset)->limit($consultationsLimit)->get();
                    $subCategory->childrenElements()->saveMany($consultationsCollection);
                    $consultationsOffset += $consultationsLimit;
                }
            }

            $categoriesOffset += $categoriesLimit;
        }
    }
}
