<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $guarded = [];

    /**
     * Get group
     *
     * @return HasRelationship
     */
    public function group()
    {
        return $this->belongsTo(ChecklistGroup::class, 'group_id');
    }
}
