<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizReponse extends Model
{
    protected $guarded = [];

    /**
     * Retourne la question a laquelle cette reponse est liee.
     */
    public function quiz_question()
    {
        return $this->belongsTo('App\QuizQuestion');
    }
}

