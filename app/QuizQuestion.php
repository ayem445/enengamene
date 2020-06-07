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

    public function setIsComplet() {
        if ($this->reponses->count() == 0) {
            $this->is_complet = false;
        } else {
            $nb_reponses_valides = 0;
            $nb_reponses_invalides = 0;
            foreach ($this->reponses as $reponse) {
                $nb_reponses_valides = ( $reponse->is_valide ? ($nb_reponses_valides + 1) : $nb_reponses_valides );
                $nb_reponses_invalides = ( $reponse->is_valide ? $nb_reponses_invalides : ($nb_reponses_invalides + 1) );
            }
            $this->is_complet = ( $nb_reponses_valides > 0 );
        }

        $this->save();
        $this->quiz->setIsComplet();
    }

    public static function boot ()
    {
        parent::boot();

        // juste avant suppression
        self::deleting(function($model) {
            //On supprime toutes les reponses
            $model->reponses()->get(['id'])->each->delete();
        });

        // Après suppression de la réponse
        self::deleted(function($model) {
            //On met à jour l'attribut is_complet du quiz parent
            $model->quiz->setIsComplet();
        });
    }
}
