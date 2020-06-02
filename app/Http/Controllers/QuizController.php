<?php

namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Request;
use App\Session;
use App\Chapitre;
use App\Cour;

class QuizController extends Controller
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
    public function create($elem_id, $elem)
    {
        dd($elem_id,$elem);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createsession(Session $session)
    {
        //dd($session);
        $store_route = "QuizController@storesession";
        return view('admin.quizs.create')
          ->withElem($session)
          ->withElemType("la session")
          ->withStoreRoute("QuizController@storesession")
          ;//, compact('matieres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storesession(Session $session, Request $request)
    {
        $data = $request->all();
        $data['code'] = Quiz::getUniqcode();

        $quiz = Quiz::create($data);
        $session->quiz_id = $quiz->id;
        $session->save();
        
        session()->flash('success', 'Quiz créé avec succès.');
        return redirect()->route('quizs.show', $quiz);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        $quiz = Quiz::with(['questions', 'questions.reponses'])->find($quiz->id);
        return view('admin.quizs.index')->withQuiz($quiz);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        //
    }

    public function addToElem($elem, $elemid, Request $request) {

    }
}
