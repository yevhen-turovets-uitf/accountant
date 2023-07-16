<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublicAgreementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('public_agreement')->insert([
            [
                'description' => "<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis maiores ipsa obcaecati magni cum tenetur libero quis, voluptatem repellat error cupiditate eaque ipsum nisi? Aspernatur!</p>
                                  <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis maiores ipsa obcaecati magni cum tenetur libero quis, voluptatem repellat error cupiditate eaque ipsum nisi? Aspernatur!</p>",
            ],
        ]);
    }
}
