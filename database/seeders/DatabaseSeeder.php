<?php

namespace Database\Seeders;

use App\Models\Question;
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
        // \App\Models\User::factory(10)->create();
        Question::create(['title' => 'A1', 'order' => 1]);
        Question::create(['title' => 'A2', 'order' => 1]);
        Question::create(['title' => 'A3', 'order' => 1]);
        Question::create(['title' => 'A4', 'order' => 1]);
        Question::create(['title' => 'B1', 'order' => 1]);
        Question::create(['title' => 'B2', 'order' => 1]);
        Question::create(['title' => 'B3', 'order' => 1]);
        Question::create(['title' => 'B4', 'order' => 1]);
        Question::create(['title' => 'C1', 'order' => 1]);
        Question::create(['title' => 'C2', 'order' => 1]);
        Question::create(['title' => 'C3', 'order' => 1]);
        Question::create(['title' => 'C4', 'order' => 1]);
        Question::create(['title' => 'D1', 'order' => 1]);
        Question::create(['title' => 'D2', 'order' => 1]);
        Question::create(['title' => 'D3', 'order' => 1]);
        Question::create(['title' => 'D4', 'order' => 1]);
    }
}
