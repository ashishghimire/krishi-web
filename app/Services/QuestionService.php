<?php
/**
 * Created by PhpStorm.
 * User: ashish
 * Date: 11/17/18
 * Time: 8:11 PM
 */

namespace App\Services;


use App\Imports\QuestionsImport;
use App\QuestionSet;
use App\Question;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class QuestionService
{
    private $question;

    public function __construct(Question $question)
    {

        $this->question = $question;
    }

    public function storeFile(Request $request, QuestionSet $questionSet)
    {
        request()->session()->put('question-set-id', $questionSet->id);
        try {
            $array = Excel::import(new QuestionsImport, $request->file('import'));
        } catch (\Exception $exception) {
            dd($exception);
        }

        request()->session()->forget('question-set-id');

        return true;
    }

    public function store(Request $request, QuestionSet $questionSet)
    {
        $data = $request->all();
        $data['question_set_id'] = $questionSet->id;

        try {
            return $this->question->create($data);
        } catch (\Exception $exception) {
            dd($exception);
        }

    }
}
