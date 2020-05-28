<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\BaseRequestTrait;

class CourRequest extends FormRequest
{
    use BaseRequestTrait;

    /**
     * Retourne le chemin du répertoire ou sont stockés les fichiers de ce modèle
     * @return [type] [description]
     */
    public function filefolder() {
        return config('app.cours_filefolder');
    }

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
            //
        ];
    }
}
