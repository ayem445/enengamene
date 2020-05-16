<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class Etablissement extends Model
{
    use BaseTrait;

    protected $guarded = [];

    /**
     * Retourne le type de l établissement.
     */
    public function type_etablissement()
    {
        return $this->belongsTo('App\TypeEtablissement');
    }

    /**
     * Retourne toutes les personnes qui sont dans cet établissement.
     */
    public function personnes()
    {
        return $this->hasMany('App\Personne', 'etablissement_id');
    }
}
