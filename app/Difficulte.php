<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class Difficulte extends Model
{
    use BaseTrait;

    protected $guarded = [];

    /**
     * Retourne tous les cours qui ont cette difficulté.
     */
    public function chapitres()
    {
        return $this->hasMany('App\Chapitre', 'difficulte_id');
    }
}

