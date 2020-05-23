<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
	protected $table = 'requests';

    protected $fillable = [
		'case_id', 'request_type', 'request_reason'
	];
}
