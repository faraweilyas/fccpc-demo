<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
	protected $table = 'guest';

    protected $fillable = [
		'email', 'tracking_id'
	];
}
