<?php

namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Request;
use App\Session;
use App\Chapitre;
use App\QuizTypeQuestion;
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
     * Charge la page de création de quiz pour une session
     * @param  Session $session Session pour laquelle le quiz sera créé
     * @return [type]           [description]
     */
    public function createsession(Session $session)
    {
        $store_route = "QuizController@storesession";
        return view('admin.quizs.create')
          ->withElem($session)
          ->withElemType("la session")
          ->withStoreRoute("QuizController@storesession")
          ;//, compact('matieres'));
    }

    /**
     * Stocke le quiz d'une session dans la base données
     * @param  Session $session Session pour laquelle le quiz sera créé
     * @param  Request $request Requête
     * @return [type]           [description]
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

    public function destroysession(Session $session, Request $request)
    {
        $data = $request->all();
        $quiz = Quiz::where('id', $data['id'])->first();
        $quiz->delete();
        return $session->fresh();
    }

    /**
     * Charge la page de création de quiz pour un chapitre
     * @param  Chapitre $chapitre Chapitre pour lequel le quiz sera créé
     * @return [type]             [description]
     */
    public function createchapitre(Chapitre $chapitre)
    {
        $store_route = "QuizController@storechapitre";
        return view('admin.quizs.create')
          ->withElem($chapitre)
          ->withElemType("le chapitre")
          ->withStoreRoute("QuizController@storechapitre")
          ;
    }

    /**
     * Stocke le quiz d'un chapitre dans la base données
     * @param  Chapitre $chapitre Chapitre pour lequel le quiz sera créé
     * @param  Request  $request  [description]
     * @return [type]             [description]
     */
    public function storechapitre(Chapitre $chapitre, Request $request)
    {
        $data = $request->all();
        $data['code'] = Quiz::getUniqcode();

        $quiz = Quiz::create($data);
        $chapitre->quiz_id = $quiz->id;
        $chapitre->save();

        session()->flash('success', 'Quiz créé avec succès.');
        return redirect()->route('quizs.show', $quiz);
    }

    public function destroychapitre(Chapitre $chapitre, Request $request)
    {
        $data = $request->all();
        $quiz = Quiz::where('id', $data['id'])->first();
        $quiz->delete();
        return $chapitre->fresh();
    }

    public function createcour(Cour $cour)
    {
        $store_route = "QuizController@storecour";
        return view('admin.quizs.create')
          ->withElem($cour)
          ->withElemType("le cour")
          ->withStoreRoute("QuizController@storecour")
          ;
    }

    public function storecour(Cour $cour, Request $request)
    {
        $data = $request->all();
        $data['code'] = Quiz::getUniqcode();

        $quiz = Quiz::create($data);
        $cour->quiz_id = $quiz->id;
        $cour->save();

        session()->flash('success', 'Quiz créé avec succès.');
        return redirect()->route('quizs.show', $quiz);
    }

    public function destroycour(Cour $cour, Request $request)
    {
        $data = $request->all();
        $quiz = Quiz::where('id', $data['id'])->first();
        $quiz->delete();
        session()->flash('success', 'Quiz supprimé avec succès.');
        return redirect()->route('cours.show', $cour);
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
        $typequestions = QuizTypeQuestion::listMap('libelle');
        $quiz = Quiz::with(['questions', 'questions.reponses', 'questions.typequestion'])->find($quiz->id);
        return view('admin.quizs.index')
          ->withQuiz($quiz)
          ->withTypequestions($typequestions);
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
        $quiz->delete();
        return redirect()->refresh();
    }

    public function addToElem($elem, $elemid, Request $request) {

    }
}
