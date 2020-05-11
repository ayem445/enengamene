<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeEtablissement extends Model
{
    protected $guarded = [];

    /**
     * Retourne tous les etablissements qui ont ce type.
     */
    public function etablissements()
    {
        return $this->hasMany('App\Etablissement', 'type_etablissement_id');
    }
}

