<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\QuizQuestion;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Quiz $quiz, Request $request)
    {
        $data = $request->all();
        //$data['quiz_type_question_id'] = 1;

        //return QuizQuestion::create($data);
        return $quiz->questions()->create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QuizQuestion  $quizQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(QuizQuestion $quizQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuizQuestion  $quizQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit(QuizQuestion $quizQuestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QuizQuestion  $quizQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(Quiz $quiz, QuizQuestion $quizQuestion, Request $request)
    {
        $data = $request->all();
        // TODO: A retirer
        $quizquestion = QuizQuestion::find($data['id']);
        $quizquestion->update($data);

        return $quizquestion->fresh();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QuizQuestion  $quizQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuizQuestion $quizQuestion)
    {
        //
    }
}
