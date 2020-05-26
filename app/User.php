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
        'firstName', 'lastName', 'email', 'password', 'accountType', 'status'
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
     * This function return the fullname of logged in user
     *
     * @return string
     */
    public function getLoggedUserFullName() {
        return \Auth::user()->firstName.' '.\Auth::user()->lastName;
    }

    /**
     * This function return the fullname of user
     *
     * @return string
     */
    public function getFullName() {
        return $this->firstName.' '.$this->lastName;
    }
}
