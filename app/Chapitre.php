<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapitre extends Model
{
    protected $guarded = [];

    /**
     * Retourne le cour auquel appartient ce chapitre.
     */
    public function cour()
    {
        return $this->belongsTo('App\Cour');
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
}

