<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class Personne extends Model
{
    use BaseTrait;

    protected $guarded = [];

    /**
     * Retourne tous les comptes de la personne.
     */
    public function comptes()
    {
        return $this->hasMany('App\User', 'personne_id');
    }

    /**
     * Retourne tous les cours de cette personne.
     */
    public function cours()
    {
        return $this->hasMany('App\Cours', 'auteur_id');
    }

    /**
     * Retourne l établissement de la Personne.
     */
    public function etablissement()
    {
        return $this->belongsTo('App\Etablissement');
    }

    /**
     * Retourne le compte Auteur de la personne.
     */
    public function auteur()
    {
        return $this->hasOne('App\Auteur');
    }
}
