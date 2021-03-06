<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $guarded = [];

    public function case()
    {
        return $this->belongsTo(Cases::class, 'case_id');
    }
}
