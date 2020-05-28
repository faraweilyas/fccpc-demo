<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
	protected $table = 'guest';

    protected $fillable = [
		'email', 'tracking_id'
	];

    public function getInitials($textStyle='strtoupper') : string
    {
        return textTransformer(substr($this->email, 0, 2), $textStyle);
    }

    public function getTrackingID($textStyle='strtoupper') : string
    {
        return textTransformer("#".$this->tracking_id, $textStyle);
    }
}
