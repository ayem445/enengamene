<?php

namespace App\Http\Controllers;

use App\Cour;
use App\Chapitre;
use Illuminate\Support\Str;
use App\Http\Requests\CreateChapitreRequest;
use App\Http\Requests\UpdateChapitreRequest;
use App\Difficulte;
use Illuminate\Http\Request;

class ChapitreController extends Controller
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
        dd('chapitre.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\CreateChapitreRequest
     * @return \Illuminate\Http\Response
     */
    // public function store($cour, CreateChapitreRequest $request)
    // {
    //     $chapitre = new chapitre;

    //     $chapitre-> code = uniqid(Str::slug($request['libelle']), true);
    //     $chapitre-> libelle =  $request['libelle'];
    //     $chapitre-> description = $request['description'];
    //     $chapitre-> difficulte_id = 1;
    //     $chapitre-> cour_id = $cour;

    //    // $chapitre-> save();

    //    // $data = $request->all();
    //    // $data['code'] = uniqid(Str::slug($data['libelle']), true);

    //     return $chapitre->save();
    // }

    public function store(Cour $cour, CreateChapitreRequest $request)
    {
        $data = $request->all();
        $data['code'] = Chapitre::getUniqcode();

        $num_ordre_auto = false;
        if (isset($data['num_ordre'])) {
          if (is_null($data['num_ordre'])) {
            $num_ordre_auto =  true;
          }
        } else {
          $num_ordre_auto =  true;
        }

        if ($num_ordre_auto) {
          $num_ordre = $cour->chapitres->count();
          $num_ordre = $num_ordre + 1;
          $data['num_ordre'] = $num_ordre;
        }
        $difficulte = Difficulte::find($data['difficulte']["id"]);
        $data['difficulte_id'] = $difficulte->id;
        unset($data['difficulte']);

        return $cour->chapitres()->create($data)->load('difficulte');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chapitre  $chapitre
     * @return \Illuminate\Http\Response
     */
    public function show(Chapitre $chapitre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chapitre  $chapitre
     * @return \Illuminate\Http\Response
     */
    public function edit(Chapitre $chapitre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chapitre  $chapitre
     * @return \Illuminate\Http\Response
     */
    public function update(Cour $cour, Chapitre $chapitre , UpdateChapitreRequest $request)
    {
        $data = $request->all();
        $difficulte = Difficulte::find($data['difficulte']["id"]);
        $data['difficulte_id'] = $difficulte->id;
        unset($data['difficulte']);
        $chapitre->update($data);

        return $chapitre->fresh()->load('difficulte');
        // //
        // $chapitre = \App\Chapitre::find($chapitreId);

        // $chapitre-> code = uniqid(Str::slug($request['libelle']), true);
        // $chapitre-> libelle =  $request['libelle'];
        // $chapitre-> description = $request['description'];
        // $chapitre-> difficulte_id = 1;

       // $chapitre-> cour_id = $cour;

    //    return $chapitre->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chapitre  $chapitre
     * @return \Illuminate\Http\Response
     */
    public function destroy($cour, $chapitre)
    {
        $chapitre = \App\Chapitre::find($chapitreId);
        $chapitre->delete();

        return response()->json(['status' => 'ok'], 200);
    }
}
