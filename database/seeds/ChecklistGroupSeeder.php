<?php

use Illuminate\Database\Seeder;

class ChecklistGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ChecklistGroup::class, 5)->create();
    }
}
