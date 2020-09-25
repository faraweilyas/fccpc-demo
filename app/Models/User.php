<?php

namespace App\Models;

use Auth;
use App\Models\UserTraits\UserGettable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, UserGettable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_type', 'first_name', 'last_name', 'email', 'status', 'password'
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
     * Get JWT Identifier
     *
     * @return key
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get claims
     *
     * @return string
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Get users first name
     *
     * @return string
     */
    public function getFirstName() : string
    {
        return !empty($this->first_name) ? $this->first_name : "";
    }

    /**
     * Get users last name
     *
     * @return string
     */
    public function getLastName() : string
    {
        return !empty($this->last_name) ? $this->last_name : "";
    }

    /**
     * Get users full name
     *
     * @return string
     */
    public function getFullName() : string
    {
        return trim($this->first_name.' '.$this->last_name);
    }

    /**
     * Get method for initials.
     *
     * @return string
     */
    public function getInitials() : string
    {
        $names      = explode(" ", $this->getFullName());
        $initials   = (count($names) > 1) ? $names[0][0]."".$names[1][0] : $names[0][0]."".$names[0][1];
        return strtoupper($initials);
    }

    /**
     * Get method for is active user.
     *
     * @return string
     */
    public function isActive() : bool
    {
        return ($this->status == "active") ? true : false;
    }


    /**
     * Get method for is active user.
     *
     * @return string
     */
    public function getCaseHandlerWorkingOnCount() : int
    {
        return 3;
    }

    /**
     * Get account type
     *
     * @return mixed $textStyle
     * @return string
     */
    public function getAccountType($textStyle = null) : string
    {
        return \AppHelper::value('account_types', strtoupper($this->account_type), $textStyle);
    }

    /**
     * Get account type html
     *
     * @return string
     */
    public function getAccountTypeHtml() : string
    {
        return \AppHelper::value('account_types_html', strtoupper($this->account_type), NULL);
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus() : string
    {
        return \AppHelper::value('status', $this->status, NULL);
    }

    /**
     * Get status html
     *
     * @return string
     */
    public function getStatusHtml() : string
    {
        return \AppHelper::value('status_html', $this->status, NULL);
    }
}
