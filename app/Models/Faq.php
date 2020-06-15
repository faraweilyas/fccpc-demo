<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    protected $table = 'faq';

    protected $fillable = [
        'creator', 'question', 'answer', 'category'
    ];
}
