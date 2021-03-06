<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class Auteur extends Model
{
    use BaseTrait;

    protected $guarded = [];
    protected $table = 'auteurs';

    /**
     * Eager load relationships
     *
     * @var array
     */
    //protected $with = ['cours','personne'];

    /**
    * renvoie le nom complet de l'auteur.
    * -- Must postfix the word 'Attribute' to the function name
    *
    * @return string
    */
    public function getNomCompletAttribute()
    {
        return $this->personne->nomComplet;
    }

    /**
     * Retourne l auteur de ce cours.
     */
    public function personne()
    {
        return $this->belongsTo('App\Personne');
    }

    /**
     * Retourne tous les cours de cet auteur.
     */
    public function cours()
    {
        return $this->hasMany('App\Cour', 'auteur_id');
    }
}
