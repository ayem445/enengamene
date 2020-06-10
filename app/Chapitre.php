<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;
use App\Session;

class Chapitre extends Model
{
    use BaseTrait;

    protected $guarded = [];
    protected $appends = ['duree'];
    protected $with = ['quiz'];

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

    /**
     * Renvoie le prochain chapitre après celui-la
     *
     * @return \App\Chapitre
     */
    public function chapitreSuiv() {
        $nextChapitre = $this->cour->chapitres()->where('num_ordre', '>', $this->num_ordre)
                    ->orderBy('num_ordre', 'asc')
                    ->first();

        if($nextChapitre) {
            return $nextChapitre;
        }

        return $this;
    }

    /**
     * Renvoie le chapitre qui vient avant celui-la
     *
     * @return \App\Chapitre
     */
    public function chapitrePrec() {
        $prevChapitre = $this->cour->chapitres()->where('num_ordre', '<', $this->num_ordre)
                    ->orderBy('num_ordre', 'desc')
                    ->first();

        if($prevChapitre) {
            return $prevChapitre;
        }

        return $this;
    }

    /**
     * Renvoie la 1ère session de ce chapitre
     *
     * @return \App\Session
     */
    public function premiereSession() {
        $firstSession = $this->sessions()
                    ->orderBy('num_ordre', 'asc')
                    ->first();

        if($firstSession) {
            return $firstSession;
        }

        return null;
    }

    /**
     * Renvoie la dernière session de ce chapitre
     *
     * @return \App\Session
     */
    public function derniereSession() {
        $firstSession = $this->sessions()
                    ->orderBy('num_ordre', 'desc')
                    ->first();

        if($firstSession) {
            return $firstSession;
        }

        return null;
    }

    public function estPremierDuCour() {
        $chapitre_precedente = Chapitre::where('cour_id', $this->chapitre->id)
            ->where('num_ordre', $this->num_ordre - 1);
        if ($chapitre_precedente) {
          return false;
        } else {
          return true;
        }
    }

    public function estDernierDuCour() {
        $chapitre_suivant = Chapitre::where('cour_id', $this->chapitre->id)
            ->where('num_ordre', $this->num_ordre + 1);
        if ($chapitre_suivant) {
          return false;
        } else {
          return true;
        }
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
            //On supprime toutes les sessions
            $model->sessions()->get(['id'])->each->delete();
        });
    }

}
