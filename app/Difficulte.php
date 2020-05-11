<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Difficulte extends Model
{
    protected $guarded = [];

    /**
     * Retourne tous les cours qui ont cette difficulté.
     */
    public function cours()
    {
        return $this->hasMany('App\Cour', 'difficulte_id');
    }
}

