<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cour;

class FrontEndController extends Controller
{
    /**
     * Show the welcome / landing page
     *
     * @return view
     */
    public function welcome() {
        $cours = Cour::all();
        return view('welcome')->withCours($cours);
    }

    /**
     * Affiche la page du cour
     *
     * @param Cour $cour
     * @return view
     */
    public function cour(Cour $cour) {
        dd($cour);
    }
}
