<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{
    protected $table = 'complaints';

    protected $fillable = [
        'tracking_id', 'firstName', 'lastName', 'email', 'phone', 'message', 'file'
    ];

    /**
     * Get full name
     *
     * @param string $textStyle
     * @return string
     */
    public function getFullName($textStyle='strtoupper') : string
    {
        return textTransformer($this->firstName.' '.$this->lastName, $textStyle);
    }
}
