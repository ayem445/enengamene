<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cour extends Model
{
    protected $guarded = [];

    /**
     * Retourne l auteur de ce cours.
     */
    public function auteur()
    {
        return $this->belongsTo('App\Personne');
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
     * Retourne la difficulté de ce cours.
     */
    public function difficulte()
    {
        return $this->belongsTo('App\Difficulte');
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

