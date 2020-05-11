<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notation extends Model
{
    protected $guarded = [];

    /**
     * Retourne la liste de User/Cour ayant cette notation.
     */
    public function cour_notation() {
        return $this->hasMany('App\CourNotation', 'notation_id');
    }
}

