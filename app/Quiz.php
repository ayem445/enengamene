<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $guarded = [];

    /**
     * Retourne toutes les questions de ce Quiz.
     */
    public function quiz_questions()
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
}
