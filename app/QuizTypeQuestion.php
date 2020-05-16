<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class QuizTypeQuestion extends Model
{
    use BaseTrait;
    protected $guarded = [];

    /**
     * Retourne toutes les questions qui ont ce type de question.
     */
    public function quiz_questions()
    {
        return $this->hasMany('App\QuizQuestion', 'quiz_type_question_id');
    }
}

