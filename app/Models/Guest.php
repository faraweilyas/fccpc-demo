<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
		'tracking_id', 'email'
	];

    /**
     * Get initials from email
     *
     * @param string $textStyle
     * @return string
     */
    public function getInitials($textStyle='strtoupper') : string
    {
        return textTransformer(substr($this->email, 0, 2), $textStyle);
    }

    /**
     * Get formatted tracking id
     *
     * @param string $textStyle
     * @return string
     */
    public function getTrackingID($textStyle='strtoupper') : string
    {
        return textTransformer("#".$this->tracking_id, $textStyle);
    }
}
