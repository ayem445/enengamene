<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizTypeQuestion extends Model
{
    protected $guarded = [];

    /**
     * Retourne toutes les questions qui ont ce type de question.
     */
    public function quiz_questions()
    {
        return $this->hasMany('App\QuizQuestion', 'quiz_type_question_id');
    }
}

