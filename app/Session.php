<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class Session extends Model
{
    use BaseTrait;

    protected $guarded = [];

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
            return $nextSession;
        }

        //return $this;
        $nextChapitre = $this->chapitre->chapitreSuiv();
        if ($nextChapitre->id == $this->chapitre_id) {
          return $this;
        }
        return $nextChapitre->premiereSession();
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
}
