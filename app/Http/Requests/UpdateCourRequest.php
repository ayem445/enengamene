<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateCourRequest extends FormRequest
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
            'description' => 'required'
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
            $this->fileName = Str::slug($this->libelle) . '.' . $uploadedImage->getClientOriginalExtension();
            $uploadedImage->storePubliclyAs(
                'public/cours',  $this->fileName
            );
        }
        $cour->libelle = $this->libelle;
        $cour->description = $this->description;

        $cour->save();
    }
}
