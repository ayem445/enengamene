<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class Chapitre extends Model
{
    use BaseTrait;

    protected $guarded = [];

    /**
     * Eager load relationships
     *
     * @var array
     */
    //protected $with = ['sessions','difficulte'];

    /**
     * Retourne le cour auquel appartient ce chapitre.
     */
    public function cour()
    {
        return $this->belongsTo('App\Cour');
    }

    /**
     * Retourne la difficulté de ce chapitre.
     */
    public function difficulte()
    {
        return $this->belongsTo('App\Difficulte');
    }

    /**
     * Retourne toutes les sessions de ce chapitre.
     */
    public function sessions()
    {
        return $this->hasMany('App\Session', 'chapitre_id');
    }

    /**
     * Retourne le Quiz de ce chapitre.
     */
    public function quiz()
    {
        return $this->belongsTo('App\Quiz');
    }

    /**
     * Obtenir une liste de sessions pour le chapitre dans l'ordre de visionnage
     *
     * @return void
     */
    public function getSessionsOrdonnees() {
        return $this->sessions()->orderBy('num_ordre', 'asc')->get();
    }
}
