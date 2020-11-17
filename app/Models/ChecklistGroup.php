<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChecklistGroup extends Model
{
    protected $guarded = [];

    public function checklists()
    {
        return $this->hasMany(Checklist::class, 'group_id');
    }

    public function isGroupFees()
    {
    	return (strtolower($this->name) == 'fees') ? true : false;
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'group_id');
    }
}
