<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestID extends Model
{
    protected $table = 'id_request';

    protected $guarded = [];

    public function getSubmittedAt(string $format='customdate') : string
    {
        return !empty($this->created_at) ? datetimeToText($this->created_at, $format) : "";
    }
}
