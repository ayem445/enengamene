<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizReponseUser extends Model
{
    protected $table = 'quiz_reponse_user';
    protected $guarded = [];

    /**
     * Retourne la question et l utilisateur est lies.
     */
    public function question_user()
    {
        return $this->belongsTo('App\QuizQuestionUser');
    }
}

