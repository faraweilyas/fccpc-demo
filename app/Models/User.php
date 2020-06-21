<?php

namespace App\Models;

use Auth;
use AppHelper;
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
        return AppHelper::$account_types[$this->account_type] ?? "";
    }

    /**
     * Get account type html
     *
     * @return string
     */
    public function getAccountTypeHtml() : string
    {
        return AppHelper::$account_typesHTML[$this->account_type];
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
