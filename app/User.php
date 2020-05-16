<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\BaseTrait;

class User extends Authenticatable
{
    use Notifiable;
    use BaseTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username','confirm_token',
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

    /**
     * Retourne toutes les questions de quiz auxquels cet utilisateur a répondu.
     */
    public function quiz_questions()
    {
        return $this->hasMany('App\QuizQuestionUser', 'user_id');
    }

    /**
     * Checks if user's email has been confirmed
     *
     * @return boolean
     */
    public function isConfirmed()
    {
        return $this->confirm_token == null;
    }

    /**
     * Confirm a user's email
     *
     * @return void
     */
    public function confirm()
    {
        $this->confirm_token = null;
        $this->save();
    }

    /**
     * Vérifiez si l'utilisateur actuel est un administrateur
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return in_array($this->email, config('enengamene.administrators'));
    }

    public function getRouteKeyName() {
        return 'username';
    }
}
