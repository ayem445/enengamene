<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class QuizReponse extends Model
{
    use BaseTrait;

    protected $guarded = [];
    protected $appends = ['selectedbyuser'];

    public function getSelectedbyuserAttribute() {
      return false;
    }

    /**
     * Retourne la question a laquelle cette reponse est liee.
     */
    public function question()
    {
        return $this->belongsTo('App\QuizQuestion', 'quiz_question_id');
    }

    public static function boot ()
    {
        parent::boot();

        // Après création d'une nouvelle réponse
        self::created(function($model){
            //On met à jour l'attribut is_complet de la question parent
            $model->question->setIsComplet();
        });

        // Après mise à jour de la réponse
        self::updated(function($model){
            //On met à jour l'attribut is_complet de la question parent
            $model->question->setIsComplet();
        });

        // Après suppression de la réponse
        self::deleted(function($model){
            //On met à jour l'attribut is_complet de la question parent
            $model->question->setIsComplet();
        });
    }
}
