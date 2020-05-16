<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BaseTrait;

class Session extends Model
{
    use BaseTrait;

    protected $guarded = [];

    /**
     * Retourne le type de contenu de cette session.
     */
    public function type_contenu()
    {
        return $this->belongsTo('App\TypeContenu');
    }

    /**
     * Retourne le chapitre de cette session.
     */
    public function chapitre()
    {
        return $this->belongsTo('App\Chapitre');
    }

    /**
     * Retourne le Quiz de cette session.
     */
    public function quiz()
    {
        return $this->belongsTo('App\Quiz');
    }
}

