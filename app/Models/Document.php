<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $guarded = [];

    public function case()
    {
        return $this->hasOne(Cases::class, 'id');
    }

    public function checklists()
    {
        return $this->belongsToMany(Checklist::class, 'checklist_document', 'document_id', 'checklist_id')
            ->as('checklist_document')
            ->withTimestamps();
    }
}
