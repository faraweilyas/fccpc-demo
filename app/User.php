<?php

namespace App;

use App\Enhancers\AppHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
     * Get users full name
     *
     * @return string
     */
    public function getFullName() : string
    {
        return trim("{$this->firstName} {$this->lastName}");
    }

    /**
     * Get method for initials.
     * @return string
     */
    public function getInitials() : string
    {
        $names      = explode(" ", $this->getFullName());
        $initials   = (count($names) > 1) ? $names[0][0]."".$names[1][0] : $names[0][0]."".$names[0][1];
        return strtoupper($initials);
    }

    /**
     * Get account type
     *
     * @return string
     */
    public function getAccountType() : string
    {
        return AppHelper::$account_types[$this->accountType];
    }

    /**
     * Get account type html
     *
     * @return string
     */
    public function getAccountTypeHtml() : string
    {
        return AppHelper::$account_typesHTML[$this->accountType];
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus() : string
    {
        return AppHelper::$status[$this->status];
    }

    /**
     * Get status html
     *
     * @return string
     */
    public function getStatusHtml() : string
    {
        return AppHelper::$statusHTML[$this->status];
    }
}
