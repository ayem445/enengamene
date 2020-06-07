<?php

namespace App\Http\Controllers;

use App\QuizReponse;
use App\QuizQuestion;
use Illuminate\Http\Request;

class QuizReponseController extends Controller
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
    public function store(QuizQuestion $quizquestion, Request $request)
    {
        $data = $request->all();
        return $quizquestion->reponses()->create($data)->load('question');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\QuizReponse  $quizReponse
     * @return \Illuminate\Http\Response
     */
    public function show(QuizReponse $quizReponse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\QuizReponse  $quizReponse
     * @return \Illuminate\Http\Response
     */
    public function edit(QuizReponse $quizReponse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\QuizReponse  $quizReponse
     * @return \Illuminate\Http\Response
     */
    public function update(QuizQuestion $quizquestion, QuizReponse $quizReponse, Request $request)
    {
        $data = $request->all();
        $quizreponse = QuizReponse::find($data['id']);
        $quizreponse->update($data);
        //$quizReponse->update($data);
        return $quizreponse->fresh()->load('question');
    }

    // QuizQuestion $quizquestion, QuizReponse $quizReponse
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\QuizReponse  $quizReponse
     * @return \Illuminate\Http\Response
     */

    /**
     * Supprime la réponse de la question d'un quiz
     * @param  QuizQuestion $quizquestion Question parent
     * @param  [type]       $id           id de la reponse à supprimer
     * @return [type]                     [description]
     */
    public function destroy(QuizQuestion $quizquestion, $id)
    {
        $quizreponse = QuizReponse::where('id', $id)->first();
        //$question = $quizreponse->question;//QuizQuestion::where('id', $quizReponse->quiz_question_id)->get()->first();
        $quizreponse->delete();

        return $quizquestion->fresh();
    }
}
