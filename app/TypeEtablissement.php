<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class TypeEtablissement extends Model
{
    use BaseTrait;
    protected $guarded = [];

    /**
     * Retourne tous les etablissements qui ont ce type.
     */
    public function etablissements()
    {
        return $this->hasMany('App\Etablissement', 'type_etablissement_id');
    }
}

