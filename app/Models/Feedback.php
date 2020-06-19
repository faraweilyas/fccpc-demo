<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';

    protected $fillable = [
        'question_id', 'ip_address', 'feedback'
    ];

    public function faq()
    {
        return $this->belongsTo(Faq::class, 'question_id');
    }
}
