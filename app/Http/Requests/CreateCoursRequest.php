<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Cour;
use App\Auteur;
use App\Matiere;
use App\NiveauEtude;
use Illuminate\Support\Str;

class CreateCoursRequest extends CourRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
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
          'niveau_etude' => 'required',
          'image' => 'required|image'
      ];
    }

    /**
     * Stocke le cours de la Reqête dans la base de données
     *
     * @return redirect()
     */
    public function storeCours()
    {
        if (! isset($this->uniqcode)) {
          $this->uniqcode = Cour::getUniqcode();
        }
        $matiere = Matiere::find(json_decode($this->matiere, true)["id"]);
        $auteur = Auteur::find(json_decode($this->auteur, true)["id"]);
        $niveau_etude = NiveauEtude::find(json_decode($this->niveau_etude, true)["id"]);
        $cours = Cour::create([
            'libelle' => $this->libelle,
            'code' => $this->uniqcode,
            'matiere_id' => $matiere->id,
            'auteur_id' => $auteur->id,
            'niveau_etude_id' => $niveau_etude->id,
            'description' => $this->description,
            'image_url' => $this->fileName
        ]);
        // $cours->code = Str::slug($this->libelle) . "_" . $cours->id;
        // $cours->save();

        session()->flash('success', 'Cours créé avec succès.');
        return redirect()->route('cours.show', $cours);
    }
}
