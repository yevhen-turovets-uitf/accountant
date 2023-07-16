<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeedbackInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('feedback_info')->insert([
            [
                'description' => "Телефон в Москве: +7 (495) 988-6004 (многоканальный)<br> 123098, Россия, г.Москва, ул.Новощукинская, д.7, корп.1, стр.2",
                'map' => "https://goo.gl/maps/JG1KqQq8j61bPBcv8",
            ],
        ]);
    }
}
