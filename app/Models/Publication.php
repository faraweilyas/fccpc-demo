<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $guarded = [];

    /**
     * Get case
     *
     * @return HasRelationship
     */
    public function case()
    {
        return $this->belongsTo(Cases::class, 'case_id');
    }

    /**
     * Check is publication is published
     *
     * @return bool
     */
    public function isPublished()
    {
        return !empty($this->published_at) ? true : false;
    }

    /**
     * Get total publications
     *
     * @param int $count
     * @param bool $count_text
     * @return integer
     */
    public function getTotalPublications($count, $count_text = FALSE)
    {
        $count_text = ($count > 1) ? 'cases' : 'case';

        if ($count_text)
            return formatNumber($count, TRUE).' '.$count_text;

        return formatNumber($count, TRUE);
    }

    /**
     * Get published date
     *
     * @param String $format
     * @return String
     */
    public function getPublishedAt($format = 'customdate')
    {
        return datetimeToText($this->published_at, $format);
    }
}
