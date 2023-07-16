<?php

namespace Database\Seeders;

use App\Models\MainSlide;
use App\Models\News;
use App\Models\PublishedOnSite;
use App\Models\Tag;
use App\Models\UsefulLink;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('Testuser1'),
            'surname' => 'Test'
        ]);

        Tag::factory(20)->create();
        News::factory(100)->create();
        MainSlide::factory(5)->create();
        PublishedOnSite::factory(20)->create();
        UsefulLink::factory(20)->create();

        $this->call(NewsTagSeeder::class);
        $this->call(FeedbackInfoSeeder::class);
        $this->call(HelpCategorySeeder::class);
        $this->call(HelpElementSeeder::class);
        $this->call(TermsOfUseSeeder::class);
        $this->call(ContractForServicesSeeder::class);
        $this->call(PublicAgreementSeeder::class);
        $this->call(CalendarYearSeeder::class);
        $this->call(FormSeeder::class);
        $this->call(CalendarReportSeeder::class);
        $this->call(CalendarDatesSeeder::class);
    }
}
