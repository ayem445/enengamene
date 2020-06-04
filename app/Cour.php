<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class Cour extends Model
{
    use BaseTrait;

    protected $guarded = [];
    protected $appends = ['duree'];

    /**
     * Eager load relationships
     *
     * @var array
     */
    //protected $with = ['matiere', 'auteur', 'niveau_etude', 'chapitres', 'chapitres.sessions'];

    /**
     * Retourne le chemin public pour l'image du cours
     *
     * @return string
     */
    public function getImagePathAttribute() {
        return asset( config('app.cours_filefolder') . '/' . $this->image_url);
    }

    /**
     * Retourne la durée du cours en secondes
     * @return [integer] durée en ss
     */
    public function getDureeSAttribute()
    {
        return $this->chapitres->sum('duree_s');
    }

    /**
     * Retourne la durée du cours en hh:mm:ss
     * @return [String] durée en hh:mm:ss
     */
    public function getDureeAttribute()
    {
        return $this->secondsToHhmmss($this->duree_s);
    }

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

    /**
     * Obtenir une liste de chapitres pour le cours dans l'ordre de visionnage
     *
     * @return void
     */
    public function getChapitresOrdonnes() {
        return $this->chapitres()->orderBy('num_ordre', 'asc')->get();
    }

    public static function boot ()
    {
        parent::boot();

        // juste avant suppression
        self::deleting(function($model){
            // On supprime le quiz s'il y en a
            if ($model->quiz) {
              $model->quiz->delete();
            }
            //On supprime tous les chapitres
            $model->chapitres()->get(['id'])->each->delete();
        });
    }
}
