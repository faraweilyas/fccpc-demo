<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $table = 'enquiry';

    protected $fillable = [
        'tracking_id', 'firm', 'firstName', 'lastName', 'email', 'phone', 'type', 'message', 'file'
    ];
}
