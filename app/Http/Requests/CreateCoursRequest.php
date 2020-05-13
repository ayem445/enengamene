<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Cour;
use Illuminate\Support\Str;

class CreateCoursRequest extends FormRequest
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
        $cours = Cour::create([
            'libelle' => $this->libelle,
            'code' => Str::slug($this->libelle),
            'description' => $this->description,
            'image_url' => 'cours/' . $this->fileName
        ]);

        session()->flash('success', 'Cours créé avec succès.');
        return redirect()->route('cours.show', $cours);
    }

    /**
     * Télécharge l'image du cors transmise dans la requête
     *
     * @return App\Http\Requests\CreateCoursRequest
     */
    public function uploadCoursImage()
    {
        $uploadedImage = $this->image;

        $this->fileName = Str::slug($this->libelle) . '.' . $uploadedImage->getClientOriginalExtension();

        $uploadedImage->storePubliclyAs(
            'public/cours',  $this->fileName
        );

        return $this;
    }
}
