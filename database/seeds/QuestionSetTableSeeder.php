<?php

use App\QuestionSet;
use Illuminate\Database\Seeder;

class QuestionSetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1,5) as $i) {
            QuestionSet::create();
        }
    }
}
