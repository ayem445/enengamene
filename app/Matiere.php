<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class Matiere extends Model
{
    use BaseTrait;

    protected $guarded = [];

    /**
     * Retourne tous les cours de cette matiere.
     */
    public function cours()
    {
        return $this->hasMany('App\Cour', 'matiere_id');
    }
}
