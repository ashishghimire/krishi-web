<?php

use App\QuestionSet;
use App\Question;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

//        dd($faker->word);
        $questionSets = QuestionSet::all();
        $questionSetIds = $questionSets->pluck('id')->toArray();
        $questionSetAnswers = ['a', 'b', 'c', 'd'];

        foreach (range(1, 5) as $i) {
//            $questionSetId = $faker->randomElement($questionSets);
            $data = [
                'question_set_id' => $faker->randomElement($questionSetIds),
                'question' => $faker->text,
                'a' => $faker->word,
                'b' => $faker->word,
                'c' => $faker->word,
                'd' => $faker->word,
                'answer' => $faker->randomElement($questionSetAnswers),
                'hint' => $faker->text,
            ];
            Question::create($data);
        }
    }
}
