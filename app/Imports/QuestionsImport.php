<?php

namespace App\Imports;

use App\Question;
//use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Question([
            'question_set_id' => request()->session()->get('question-set-id'),
            'question' => trim($row['question']),
            'a' => trim($row['option1']),
            'b' => trim($row['option2']),
            'c' => trim($row['option3']),
            'd' => trim($row['option4']),
            'answer' => trim($row['answer']),
            'hint' => trim($row['hint']),
        ]);
    }

    /**
     * @param array $array
     */
//    public function collection($row)
//    {
//        return new Question([
//            'question_set_id' => 1,
//            'question' => $row['question'],
//            'a' => $row['option1'],
//            'b' => $row['option2'],
//            'c' => $row['option3'],
//            'd' => $row['option4'],
//            'answer' => trim($row['answer']),
//        ]);
//    }
}
