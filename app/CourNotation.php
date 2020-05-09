<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourNotation extends Model
{
    public $incrementing = true;
    protected $table = 'cour_notation';

    protected $guarded = [];

    /**
     * Retourne le cours noté.
     */
    public function cour() {
        return $this->belongsTo('App\Cour');
    }

    /**
     * Retourne la notation attribuée.
     */
    public function notation()
    {
        return $this->belongsTo('App\Notation');
    }

    /**
     * Retourne le compte (User) noteur.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
