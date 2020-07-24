<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChecklistDocument extends Model
{
	protected $table   = 'checklist_documents';
    protected $guarded = [];

    public function checklists()
    {
        return $this->hasMany(Checklist::class, 'checklist_id');
    }

    public function document()
    {
        return $this->hasOne(Document::class, 'document_id');
    }
}
