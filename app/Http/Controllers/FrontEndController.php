<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cour;
use App\Auteur;
use App\Matiere;

class FrontEndController extends Controller
{
    /**
     * Show the welcome / landing page
     *
     * @return view
     */
    public function welcome() {
        $cours = Cour::with('matiere')->get();
        $auteurs = Auteur::with('personne')->get();
        $matieres = Matiere::all();
        return view('welcome')
          ->withCours($cours)
          ->withAuteurs($auteurs)
          ->withMatieres($matieres);
    }

    public function coursall() {
        return view('coursall');
    }

    public function coursgetall(Request $request) {
        // $cours = Cour::all();
        // return view('coursall')->withCours($cours);
        $q = null;
        if ($request->has('q')) $q = $request->query('q');
        $data = Cour::search($q)->paginate(3);
    	  return response()->json($data);
    }

    /**
     * Affiche la page du cour
     *
     * @param Cour $cour
     * @return view
     */
    public function cour(Cour $cour) {
        $cour = Cour::find($cour->id);
        return view('cours')->withCour($cour);
    }
}
