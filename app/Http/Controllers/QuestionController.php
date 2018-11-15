<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Question;
use App\QuestionSet;
use App\Services\QuestionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class QuestionController extends Controller
{
    /**
     * @var QuestionService
     */
    private $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(QuestionSet $questionSet)
    {
        if (request()->query('form')) {
            return view('question.create-form', compact('questionSet'));
        }

        return view('question.create', compact('questionSet'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request, QuestionSet $questionSet)
    {
        if ($request->has('form')) {
            return $this->storeForm($request, $questionSet);
        }

        if ($request->has('import')) {
            return $this->storeFile($request, $questionSet);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, Question $question)
    {
        try {
            $question->update($request->all());
        } catch (\Exception $e) {
            dd($e);
        }

        return redirect()->route('question-set.show', $question->questionSet);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question $question
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Question $question)
    {
        try {
            $question->delete();
        } catch (\Exception $e) {
            dd($e);
        }

        return redirect()->route('question-set.show', $question->questionSet);

    }

    private function storeForm($request, $questionSet)
    {
        switch ($request->submit) {

            case trans('form.save-next'):
                if (!$this->questionService->store($request, $questionSet)) {
                    return redirect()->back();
                }

                return view('question.create-form', compact('questionSet'));
                break;

            case trans('form.save-close'):
                if (!$this->questionService->store($request, $questionSet)) {
                    return redirect()->back();
                }

                return redirect()->route('question-set.show', $questionSet->id);
                break;
        }

        return redirect()->route('home');
    }

    private function storeFile($request, $questionSet)
    {
        if ($this->questionService->storeFile($request, $questionSet)) {
            return redirect()->route('question-set.show', $questionSet->id);
        }
    }

}
