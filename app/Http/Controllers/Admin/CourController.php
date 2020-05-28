<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Cour;
use App\Matiere;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCoursRequest;
use App\Http\Requests\UpdateCourRequest;
use App\NiveauEtude;
use App\Auteur;
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
        $matieres = Matiere::listMap('libelle');
        $auteurs = Auteur::listMap('nomComplet');;
        $niveauEtudes = NiveauEtude::listMap('libelle');

        return view('admin.cours.create')
          ->withMatieres($matieres)
          ->withAuteurs($auteurs)
          ->withNiveauEtudes($niveauEtudes)
          ;//, compact('matieres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Request\CreateCoursRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCoursRequest $request)
    {
        //$matiere = json_decode($request->matiere, true);
        // $matiere = (Matiere) $request->matiere_id;

        //dd($matiere,$request);
        return $request->verifyAndStoreImage()
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
        $matieres = Matiere::listMap('libelle');
        $auteurs = Auteur::listMap('nomComplet');
        $niveauEtudes = NiveauEtude::listMap('libelle');

        return view('admin.cours.edit')->withCour($cour)
          ->withMatieres($matieres)
          ->withAuteurs($auteurs)
          ->withNiveauEtudes($niveauEtudes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Request\UpdateCourRequest  $request
     * @param  \App\Cour  $cour
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourRequest $request, Cour $cour)
    {
        $request->verifyAndStoreImage($cour->image_url)
          ->updateCour($cour);

        session()->flash('success', 'Cours mis à jour avec succès');
        return redirect()->route('cours.index');
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
