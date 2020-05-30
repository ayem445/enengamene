<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class Chapitre extends Model
{
    use BaseTrait;

    protected $guarded = [];
    protected $appends = ['duree'];

    /**
     * Eager load relationships
     *
     * @var array
     */
    //protected $with = ['sessions','difficulte'];

    /**
     * Retourne la durée du chapitre en secondes
     * @return [integer] durée en ss
     */
    public function getDureeSAttribute()
    {
        return $this->sessions->sum('duree_s');
    }

    /**
     * Retourne la durée du chapitre en hh:mm:ss
     * @return [String] durée en hh:mm:ss
     */
    public function getDureeAttribute()
    {
        return $this->secondsToHhmmss($this->duree_s);
    }

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
