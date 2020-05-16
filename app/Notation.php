<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class Notation extends Model
{
    use BaseTrait;

    protected $guarded = [];

    /**
     * Retourne la liste de User/Cour ayant cette notation.
     */
    public function cour_notation() {
        return $this->hasMany('App\CourNotation', 'notation_id');
    }
}
