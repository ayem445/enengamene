<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class Cour extends Model
{
    use BaseTrait;

    protected $guarded = [];

    /**
     * Eager load relationships
     *
     * @var array
     */
    protected $with = ['chapitres', 'chapitres.sessions'];

    /**
     * Retourne l auteur de ce cours.
     */
    public function auteur()
    {
        return $this->belongsTo('App\Auteur');
    }

    /**
     * Retourne la matiere de ce cours.
     */
    public function matiere()
    {
        return $this->belongsTo('App\Matiere');
    }

    /**
     * Retourne le niveau d étude de ce cours.
     */
    public function niveau_etude()
    {
        return $this->belongsTo('App\NiveauEtude');
    }

    /**
     * Retourne tous les chapitre de ce cours.
     */
    public function chapitres()
    {
        return $this->hasMany('App\Chapitre', 'cour_id');
    }

    /**
     * Retourne le Quiz de ce cours.
     */
    public function quiz()
    {
        return $this->belongsTo('App\Quiz');
    }

    /**
     * Retourne la liste de Notation/User attribués a ce cours.
     */
    public function cour_notation() {
        return $this->hasMany('App\CourNotation', 'cour_id');
    }
}

