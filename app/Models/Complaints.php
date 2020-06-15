<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{
    protected $table = 'complaints';

    protected $fillable = [
        'tracking_id', 'caseHandler', 'firstName', 'lastName', 'email', 'phone', 'message', 'file', 'status'
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

    public function getMessage($textStyle='strtoupper') : string
    {
        return textTransformer(shortenContent($this->message ?? '...', 30), $textStyle);
    }

    /**
     * Get case handler
     *
     * @param string $textStyle
     * @return string
     */
    public function getCaseHandler($textStyle='strtoupper') : string
    {
        if ($this->caseHandler != null) {
            $result = User::where('id', $this->caseHandler)->first();
            return textTransformer($result->getFullName(), $textStyle);
        }
        return textTransformer('unassigned', $textStyle);
    }
}
