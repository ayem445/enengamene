<?php

namespace App\Http\Requests;

use App\Cour;
use App\Auteur;
use App\Matiere;
use App\NiveauEtude;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateCourRequest extends CourRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'libelle' => 'required',
            'description' => 'required',
            'auteur' => 'required',
            'matiere' => 'required',
            'niveau_etude' => 'required'
        ];
    }

    /**
     * Mise à jour d'un cours dans la base de données
     *
     * @param [App\Cour] $cour
     * @return void
     */
    public function updateCour($cour) {
        if($this->hasFile('image')) {
            $cour->image_url = $this->fileName;
        }
        $matiere = Matiere::find(json_decode($this->matiere, true)["id"]);
        $auteur = Auteur::find(json_decode($this->auteur, true)["id"]);
        $niveau_etude = NiveauEtude::find(json_decode($this->niveau_etude, true)["id"]);

        $cour->libelle = $this->libelle;
        $cour->matiere_id = $matiere->id;
        $cour->auteur_id = $auteur->id;
        $cour->niveau_etude_id = $niveau_etude->id;
        $cour->description = $this->description;

        $cour->save();
    }
}
