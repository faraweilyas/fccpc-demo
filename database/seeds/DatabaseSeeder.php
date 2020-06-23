<?php

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
        $this->call([
            UserSeeder::class,
            GuestSeeder::class,
            CaseSeeder::class,
            DocumentSeeder::class,
            EnquirySeeder::class,
            FaqSeeder::class,
            FeedbackSeeder::class,
        ]);
    }
}
