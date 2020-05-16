<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class Astuce extends Model
{
    use BaseTrait;

    protected $guarded = [];

    /**
     * Retourne l auteur de ce cours.
     */
    public function quiz_question()
    {
        return $this->belongsTo('App\QuizQuestion');
    }
}

