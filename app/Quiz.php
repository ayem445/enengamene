<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;
use App\Traits\WatchNavigationTrait;

class Quiz extends Model
{
    use BaseTrait, WatchNavigationTrait;

    protected $table = 'quizs';
    protected $guarded = [];
    protected $appends = ['nbquestions','isdoable'];

    public function getNbquestionsAttribute() {
      return $this->questions()->count();
    }

    /**
     * Détermine si ce quiz peut etre effectué
     * @return bool [description]
     */
    public function getIsdoableAttribute() {
      return true;
    }

    /**
     * Retourne toutes les questions de ce Quiz.
     */
    public function questions()
    {
        return $this->hasMany('App\QuizQuestion', 'quiz_id')->orderBy('id', 'asc');
    }

    /**
     * Retourne tous les cours qui utilisent ce Quiz.
     */
    public function cour()
    {
        return $this->hasOne('App\Cour', 'quiz_id');
    }

    /**
     * Retourne tous les chapitre qui utilisent ce Quiz.
     */
    public function chapitre()
    {
        return $this->hasOne('App\Chapitre', 'quiz_id');
    }

    /**
     * Retourne toutes les sessions qui utilisent ce Quiz.
     */
    public function session()
    {
        return $this->hasOne('App\Session', 'quiz_id');
    }

    public function setSessionSuivant() {
        if ($this->cour) {
            $sessionsuivant = $this->cour->dernierChapitre()->derniereSession();
        } elseif ($this->chapitre) {
            $sessionsuivant = $this->chapitre->derniereSession();
        } else {
            $sessionsuivant = $this->session->sessionSuiv();
        }

        $this->setNextLink($sessionsuivant);
    }

    public function setIsComplet() {
        if ($this->questions->count() == 0) {
          $this->is_complet = false;
        } else {
          $this->is_complet = true;
          foreach ($this->questions as $question) {
              $this->is_complet = ($this->is_complet && $question->is_complet);
          }
        }

        $this->save();
    }

    public static function boot ()
    {
        parent::boot();

        // juste avant suppression
        self::deleting(function($model){
            //On supprime toutes les questions
            $model->questions()->get(['id'])->each->delete();
        });
    }
}
