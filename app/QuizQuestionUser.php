<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizQuestionUser extends Model
{
    protected $table = 'quiz_question_user';
    protected $guarded = [];

    /**
     * Retourne la question et l utilisateur est lies.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Retourne la question et l utilisateur est lies.
     */
    public function question()
    {
        return $this->belongsTo('App\QuizQuestion');
    }

    /**
     * Retourne toutes les réponses données par l utilisateur pour cette question.
     */
    public function user_reponses()
    {
        return $this->hasMany('App\QuizReponseUser', 'quiz_question_user_id');
    }

    /**
     * Retourne toutes les réponses de cette question.
     */
    public function nombre_reponses_user_valides()
    {
        return $this->user_reponses()->where('is_valide', true)->count();
    }

    /**
     * Score obtenu par l utilisateur pour cette question
     * @return [type] [description]
     */
    public function score() {
        return ($this->question()->nombre_reponses_valides / $this->nombre_reponses_user_valides()) * 100;
    }
}

