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

    public function checklistDocuments()
    {
        return $this->hasMany(ChecklistDocument::class, 'document_id');
    }
}
