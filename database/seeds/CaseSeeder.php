<?php

use App\Models\Cases;
use Illuminate\Database\Seeder;

class CaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Cases::class, 20)->create();
    }
}
