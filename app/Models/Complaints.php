<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{
    protected $table = 'enquiry';

    protected $fillable = [
        'tracking_id', 'firstName', 'lastName', 'email', 'phone', 'message', 'file'
    ];
}
