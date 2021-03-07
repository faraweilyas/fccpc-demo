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

    public function isPublished()
    {
        return !empty($this->published_at) ? true : false;
    }

    public function getTotalPublications($count_text = FALSE){
        $count = static::where('published_at', '!=', NULL)->count();
        $count_text = ($count > 1) ? 'cases' : 'case';

        if ($count_text)
            return formatNumber($count, TRUE).' '.$count_text;

        return formatNumber($count, TRUE);
    }
}
