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

        // $users = factory(App\Models\User::class, 3)->make();
        // $guests = factory(App\Models\Guest::class, 3)->make();
        // $cases = factory(App\Models\Cases::class, 3)->make([
        //     'user_id' => NULL,
        //     'guest_id' => 1,
        // ]);
        // $documents = factory(App\Models\Document::class, 3)->make([
        //     'case_id' => 2,
        // ]);
        // $enquiries = factory(App\Models\Enquiry::class, 3)->make();
        // $faqs = factory(App\Models\Faq::class, 3)->make([
        //     'user_id' => 3,
        // ]);
        // $feedbacks = factory(App\Models\Feedback::class, 3)->make([
        //     'faq_id' => 1,
        // ]);
    }
}
