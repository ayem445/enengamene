<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    protected $guarded = [];

    /**
     * Retourne tous les cours de cette matiere.
     */
    public function cours()
    {
        return $this->hasMany('App\Cour', 'matiere_id');
    }
}

