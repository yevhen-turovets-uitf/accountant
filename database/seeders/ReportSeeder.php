<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\ReportCategory;
use App\Models\ReportRedaction;
use App\Models\TaxSystem;
use App\Models\TaxSystemCategory;
use App\Models\TaxSystemRedaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReportSeeder extends Seeder
{
    public function run()
    {
        DB::table('reports')->delete();
        DB::table('report_categories')->delete();
        DB::table('report_redactions')->delete();

        if(Env::get('DB_CONNECTION') == 'mysql') {
            DB::statement('ALTER TABLE reports AUTO_INCREMENT = 1');
            DB::statement('ALTER TABLE report_categories AUTO_INCREMENT = 1');
            DB::statement('ALTER TABLE report_redactions AUTO_INCREMENT = 1');
        } elseif (Env::get('DB_CONNECTION') == 'pgsql') {
            DB::statement('ALTER SEQUENCE reports_id_seq RESTART WITH 1');
            DB::statement('ALTER SEQUENCE report_categories_id_seq RESTART WITH 1');
            DB::statement('ALTER SEQUENCE report_redactions_id_seq RESTART WITH 1');
        } elseif (Env::get('DB_CONNECTION') == 'sqlite') {
            DB::insert('insert into sqlite_sequence (name, seq) values (?, ?)', ['reports', 1]);
            DB::insert('insert into sqlite_sequence (name, seq) values (?, ?)', ['report_categories', 1]);
            DB::insert('insert into sqlite_sequence (name, seq) values (?, ?)', ['report_redactions', 1]);
        }

        DB::table('report_categories')->insert([
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
        $reportsOffset = 0;
        $reportsLimit = 2;

        Report::factory(360)->create();
        ReportCategory::factory(180)->create();
        ReportRedaction::factory(450)->create();

        for ($i = 1; $i <= 6; $i++) {
            $categories = ReportCategory::offset($categoriesOffset)->limit($categoriesLimit)->get();

            foreach ($categories as $category) {
                $category->category_id = $i;
                $category->update();

                $reportsCollection = Report::offset($reportsOffset)->limit($reportsLimit)->get();
                $category->childrenElements()->saveMany($reportsCollection);

                $reportsOffset += $reportsLimit;
                $categoriesOffset += $categoriesLimit;

                $subCategories = ReportCategory::offset($categoriesOffset)->limit($categoriesLimit)->get();

                foreach ($subCategories as $subCategory) {
                    $subCategory->category_id = $category->id;
                    $subCategory->update();

                    $reportsCollection = Report::offset($reportsOffset)->limit($reportsLimit)->get();
                    $subCategory->childrenElements()->saveMany($reportsCollection);
                    $reportsOffset += $reportsLimit;
                }
            }

            $categoriesOffset += $categoriesLimit;
        }
    }
}
