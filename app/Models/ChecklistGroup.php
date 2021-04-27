<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChecklistGroup extends Model
{
    protected $guarded = [];

    /**
     * Get checklists
     *
     * @return HasRelationships
     */
    public function checklists()
    {
        return $this->hasMany(Checklist::class, 'group_id');
    }

    /**
     * Check is group is fees
     *
     * @return Bool
     */
    public function isGroupFees()
    {
    	return (strtolower($this->name) == 'fees') ? true : false;
    }

    /**
     * Get documents
     *
     * @return HasRelationships
     */
    public function documents()
    {
        return $this->hasMany(Document::class, 'group_id');
    }
}
