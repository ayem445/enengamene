<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Cour extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'libelle' => $this->name,
            'image' => $this->image_path,
            'auteur' => $this->auteur->nom_complet,
            'matiere' => $this->matiere->libelle,
            'niveau_etude' => $this->niveau_etude->libelle,
            'manage_url' => route('cours.index', $this->id),
            'edit_url' => route('cours.edit', $this->id),
            'destroy_url' => route('cours.destroy', $this->id),
        ];
    }
}
