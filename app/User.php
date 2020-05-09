<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Retourne la personne qui a ce compte (User).
     */
    public function personne()
    {
        return $this->belongsTo('App\Personne');
    }

    /**
     * Retourne la liste de Notation/Cour effectués par ce compte (User).
     */
    public function cour_notation() {
        return $this->hasMany('App\CourNotation', 'user_id');
    }
}
