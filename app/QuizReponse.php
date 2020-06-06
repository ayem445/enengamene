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
        return $this->belongsTo('App\QuizQuestion');
    }
}
