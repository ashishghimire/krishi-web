<?php

namespace App\Http\Controllers;

use App\QuestionSet;
use App\Services\QuestionService;
use Illuminate\Http\Request;
use App\Imports\QuestionsImport;
use Maatwebsite\Excel\Facades\Excel;

class QuestionSetController extends ApiController
{
    private $questionSet;
    /**
     * @var QuestionService
     */
    private $questionService;

    public function __construct(QuestionSet $questionSet, QuestionService $questionService)
    {
        $this->questionSet = $questionSet;
        $this->middleware('api')->only('getAllQuestions');
        $this->middleware('auth')->except('getAllQuestions');
        $this->questionService = $questionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questionSets = $this->questionSet->with('questions')->orderBy('created_at','desc')->has('questions')->paginate(5);


        return view('question-set.index', compact('questionSets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!request()->query('form')){
            return view('question-set.create');
        }

        $questionSet = $this->questionSet->create();

        return view('question.create-form', compact('questionSet'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->has('import')) {
            return redirect()->back();
        }

        $questionSet = $this->questionSet->create($request->all());

        if ($this->questionService->storeFile($request, $questionSet)) {
            return redirect()->route('question-set.show', $questionSet->id);
        }

        return redirect()->back()->with('message', 'Error');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QuestionSet $questionSet
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionSet $questionSet)
    {
        $questions = $questionSet->questionsPaginated();

        return view('question-set.show', compact('questions', 'questionSet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuestionSet $questionSet
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionSet $questionSet)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\QuestionSet $questionSet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestionSet $questionSet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QuestionSet $questionSet
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionSet $questionSet)
    {
        try {
            $questionSet->delete();
        } catch (\Exception $e) {
            dd($e);
        }

        return redirect()->route('question-set.index');
    }

    public function getAllQuestions()
    {
        $questionSets = $this->questionSet->with('questions')->orderBy('created_at','desc')->has('questions')->get();

        return $this->respond([
            'data' => $this->transform($questionSets),
        ]);
    }

    private function transform($questionSets)
    {
        $transformed = [];
        foreach ($questionSets as $questionSet) {
            $questions = [];
            foreach ($questionSet->questions as $questionObject) {
                $question = [
                    'question' => $questionObject->question,
                    'options' => [
                        'a' => $questionObject->a,
                        'b' => $questionObject->b,
                        'c' => $questionObject->c,
                        'd' => $questionObject->d,
                    ],
                    'answer' => $questionObject->answer,
                    'hint' => $questionObject->hint,
                ];
                array_push($questions, $question);
            }
            $questionSetArray = [
                'key' => $questionSet->id,
                'questionSet' => $questions,
            ];
            array_push($transformed, $questionSetArray);
        }

        return $transformed;
    }
}
