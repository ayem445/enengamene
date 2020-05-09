<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NiveauEtude extends Model
{
    protected $guarded = [];

    /**
     * Retourne tous les cours qui ont ce niveau d étude.
     */
    public function cours()
    {
        return $this->hasMany('App\Cour', 'niveau_etude_id');
    }
}
