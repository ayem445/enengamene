<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeContenu extends Model
{
    protected $guarded = [];

    /**
     * Retourne toutes les sessions qui ont ce type de contenu.
     */
    public function sessions()
    {
        return $this->hasMany('App\Session', 'type_contenu_id');
    }
}

