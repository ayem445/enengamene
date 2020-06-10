<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;
use App\Traits\WatchNavigationTrait;

class Session extends Model
{
    use BaseTrait, WatchNavigationTrait;

    protected $guarded = [];
    protected $with = ['quiz'];

    /**
     * Retourne le type de contenu de cette session.
     */
    public function type_contenu()
    {
        return $this->belongsTo('App\TypeContenu');
    }

    /**
     * Retourne le chapitre de cette session.
     */
    public function chapitre()
    {
        return $this->belongsTo('App\Chapitre');
    }

    /**
     * Retourne le Quiz de cette session.
     */
    public function quiz()
    {
        return $this->belongsTo('App\Quiz');
    }

    /**
     * Renvoie la prochaine session après celle-la
     *
     * @return \App\Session
     */
    public function sessionSuiv() {
        $nextSession = $this->chapitre->sessions()->where('num_ordre', '>', $this->num_ordre)
                    ->orderBy('num_ordre', 'asc')
                    ->first();

        if($nextSession) {
            $this->setNextLink($nextSession);
            return $nextSession;
        }

        //return $this;
        $nextChapitre = $this->chapitre->chapitreSuiv();
        if ($nextChapitre->id == $this->chapitre_id) {
          $this->setNextLink($this);
          return $this;
        }

        $nextSession = $nextChapitre->premiereSession();
        $this->setNextLink($this);
        return $nextSession;
    }

    /**
     * Renvoie la session qui vient avant celle-la
     *
     * @return \App\Session
     */
    public function sessionPrec() {
        $prevSession = $this->chapitre->sessions()->where('num_ordre', '<', $this->num_ordre)
                    ->orderBy('num_ordre', 'desc')
                    ->first();

        if($prevSession) {
            return $prevSession;
        }

        //return $this;
        $prevChapitre = $this->chapitre->chapitrePrec();
        if ($prevChapitre->id == $this->chapitre_id) {
          return $this;
        }
        return $prevChapitre->derniereSession();
    }

    public function estPremiereDuChapitre() {
        $session_precedente = Session::where('chapitre_id', $this->chapitre->id)
            ->where('num_ordre', $this->num_ordre - 1);
        if ($session_precedente) {
          return false;
        } else {
          return true;
        }
    }

    public function estDerniereDuChapitre() {
        $session_suivant = Session::where('chapitre_id', $this->chapitre->id)
            ->where('num_ordre', $this->num_ordre + 1);
        if ($session_suivant) {
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
        });
    }
}
