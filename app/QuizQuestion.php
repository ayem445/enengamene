<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class QuizQuestion extends Model
{
    use BaseTrait;

    protected $guarded = [];
    protected $appends = ['userreponse','userreponsevalide'];

    public function getUserreponseAttribute() {
      return "";
    }

    public function getUserreponsevalideAttribute() {
      return "";
    }

    /**
     * Retourne le type de question de la question.
     */
    public function typequestion()
    {
        return $this->belongsTo('App\QuizTypeQuestion', 'quiz_type_question_id');
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
    public function reponses()
    {
        return $this->hasMany('App\QuizReponse', 'quiz_question_id');
    }

    /**
     * Retourne tous les astuces de cette question.
     */
    public function astuces()
    {
        return $this->hasMany('App\Astuce', 'quiz_question_id');
    }

    /**
     * Retourne toutes les réponses de cette question.
     */
    public function nombre_reponses_valides()
    {
        return $this->quiz_reponses()->where('is_valide', true)->count();
    }

    public static function boot ()
    {
        parent::boot();

        // juste avant suppression
        self::deleting(function($model){
            //On supprime toutes les reponses
            $model->reponses()->get(['id'])->each->delete();
        });
    }
}
