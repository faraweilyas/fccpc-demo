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
            ->withPivot('status')
            ->as('checklist_document')
            ->withTimestamps();
    }

    public function getIconText()
    {
        $extensions     = ['pdf' => 'pdf', 'doc' => 'doc', 'docx' => 'doc', 'csv' => 'csv', 'zip' => 'zip'];
        $path           = "/assets/backend/media/svg/";
        $fileExtension  = pathinfo($this->file)['extension'] ?? '';
        $extension      = $extensions[$fileExtension] ?? '';
        $file           = (in_array($fileExtension, array_keys($extensions))) ? "files/{$extension}.svg" : 'icons/Files/File.svg';
        return "{$path}{$file}";
    }
}
