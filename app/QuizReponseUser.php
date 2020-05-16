<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class QuizReponseUser extends Model
{
    use BaseTrait;

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

