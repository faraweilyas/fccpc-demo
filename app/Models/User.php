<?php

namespace App\Models;

use Auth;
use App\Models\Cases;
use App\Models\UserTraits\UserGettable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function countUnreadNotifications()
    {
        return $this->unreadNotifications->count();
    }

    public function countReadNotifications()
    {
        return $this->readNotifications->count();
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
     * Check if user is the same.
     *
     * @return string
     */
    public function isHandlerSame(Cases $case, User $user) : bool
    {
        $active_handler = $case->active_handlers[0] ?? NULL;

        if (is_null($active_handler)) return false;

        return ($this->id == $user->id) ? true : false;
    }

    /**
     * Check if user is the same.
     *
     * @return string
     */
    public function isUserSame(User $user) : bool
    {
        return ($this->id == $user->id) ? true : false;
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
     * Check if user is case handler.
     *
     * @return string
     */
    public function isCaseHandler() : bool
    {
        return ($this->account_type == "CH") ? true : false;
    }

     /**
     * Get method for is active user admin.
     *
     * @return string
     */
    public function isAdmin() : bool
    {
        return ($this->account_type == "AD") ? true : false;
    }

     /**
     * Get method for is active user supervisor.
     *
     * @return string
     */
    public function isSupervisor() : bool
    {
        return ($this->account_type == "SP") ? true : false;
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

    public function getStatus($textStyle='ucfirst') : string
    {
        return \AppHelper::value('status', $this->status, $textStyle) ?? "";
    }

    public function getStatusHtml($textStyle='ucfirst') : string
    {
        $status       = $this->getStatus($textStyle);
        $statusHtml   = \AppHelper::value('status_html', $this->status, NULL) ?? "";
        return "<span class='label label-{$statusHtml} label-dot mr-2'></span>
                <span class='font-weight-bold text-{$statusHtml}'>{$status}</span>";
    }

    public function getCreatedAt(string $format='customdate') : string
    {
        return !empty($this->created_at) ? datetimeToText($this->created_at, $format) : "";
    }
}
