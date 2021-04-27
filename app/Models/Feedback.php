<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';

    protected $guarded = [];

    /**
     * Get faq
     *
     * @return HasRelationship
     */
    public function faq()
    {
        return $this->belongsTo(Faq::class);
    }
}
