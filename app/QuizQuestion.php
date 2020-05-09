<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $guarded = [];

    /**
     * Retourne le type de question de la question.
     */
    public function type_question()
    {
        return $this->belongsTo('App\QuizTypeQuestion');
    }

    /**
     * Retourne le quiz auquel appartient la question.
     */
    public function quiz()
    {
        return $this->belongsTo('App\Quiz');
    }

    /**
     * Retourne toutes les réponses de cette question.
     */
    public function quiz_reponses()
    {
        return $this->hasMany('App\QuizReponse', 'quiz_question_id');
    }
}
