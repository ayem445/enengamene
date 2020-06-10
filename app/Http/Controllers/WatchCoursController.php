<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Chapitre;
use App\Cour;

class WatchCoursController extends Controller
{
    /**
     * Lit un cours
     *
     * @param App\Cour $cour
     * @return redirect
     */
    public function index(Cour $cour) {

      return redirect()->route('cours.watch',
          //'/chapitre/{chapitre}/session/{session}'
          ['chapitre' => $cour->chapitres->first()->id, 'session' => $cour->chapitres->first()->sessions->first()->id]
      );

    }

    /**
     * Show a lesson page
     *
     * @param App\Chapitre $chapitre
     * @param App\Session $session
     * @return view
     */
    public function showSession(Chapitre $chapitre, Session $session) {
      return view('watch', [
          'chapitre' => $chapitre,
          'session' => $session
      ]);
    }

    public function showFinCours(Cour $cour) {
      return view('fincour', [
          'cour' => $cour
      ]);
    }

    /**
     * Terminer une session via ajax
     *
     * @param App\Session $session
     * @return json response
     */
    public function terminerSession(Session $session) {
        auth()->user()->terminerSession($session);
        return response()->json([
            'status' => 'ok'
        ]);
    }
}
