<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
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
}
