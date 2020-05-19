<?php

namespace App\Http\Controllers;

use App\Cour;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCoursRequest;
use App\Matiere;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.cours.all')->withCours(Cour::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$matieres = Matiere::all()->pluck('libelle', 'id');
        //$matieres = $matieres->toArray();
        //dd($matieres);
        //

        $matieres_list = DB::table('matieres')->orderBy('libelle', 'asc')->get();
        $matieres = $matieres_list->map(function($matiere) {
          return ["value" => $matiere->id,"label" => $matiere->libelle];
        });

        return view('admin.cours.create')->withMatieres($matieres);//, compact('matieres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Request\CreateCoursRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCoursRequest $request)
    {
        return $request->uploadCoursImage()
              ->storeCours();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cour  $cour
     * @return \Illuminate\Http\Response
     */
    public function show(Cour $cour)
    {
        //$cour = Cour::with(['chapitres', 'chapitres.sessions'])->find($cour->id);
        return view('admin.cours.index')->withCour($cour);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cour  $cour
     * @return \Illuminate\Http\Response
     */
    public function edit(Cour $cour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cour  $cour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cour $cour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cour  $cour
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cour $cour)
    {
        //
    }
}
