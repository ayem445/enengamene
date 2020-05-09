<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etablissement extends Model
{
    protected $guarded = [];

    /**
     * Retourne le type de l établissement.
     */
    public function type_etablissement()
    {
        return $this->belongsTo('App\TypeEtablissement');
    }
}
