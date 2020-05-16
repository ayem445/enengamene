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
    protected $with = ['cours','personne'];

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

