<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class Quiz extends Model
{
    use BaseTrait;

    protected $table = 'quizs';
    protected $guarded = [];
    protected $appends = ['nbquestions'];

    public function getNbquestionsAttribute() {
      return $this->questions()->count();
    }

    /**
     * Retourne toutes les questions de ce Quiz.
     */
    public function questions()
    {
        return $this->hasMany('App\QuizQuestion', 'quiz_id');
    }

    /**
     * Retourne tous les cours qui utilisent ce Quiz.
     */
    public function cours()
    {
        return $this->hasMany('App\Cour', 'quiz_id');
    }

    /**
     * Retourne tous les chapitre qui utilisent ce Quiz.
     */
    public function chapitre()
    {
        return $this->hasMany('App\Chapitre', 'quiz_id');
    }

    /**
     * Retourne toutes les sessions qui utilisent ce Quiz.
     */
    public function sessions()
    {
        return $this->hasMany('App\Session', 'quiz_id');
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
