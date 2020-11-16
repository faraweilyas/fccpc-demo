<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $guarded = [];

    public function case()
    {
        return $this->hasOne(Cases::class, 'id', 'case_id');
    }

    public function checklists()
    {
        return $this->belongsToMany(Checklist::class, 'checklist_document', 'document_id', 'checklist_id')
            ->withPivot('status', 'selected_at')
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

    public function getAdditionalInfo() : string
    {
        return empty($this->additional_info) ? "..." : $this->additional_info;
    }

    public function getChecklistDocument($checklist)
    {
        $checklist_document = $this
                                ->checklists
                                ->where('id', $checklist->id)
                                ->first();

        return $checklist_document->checklist_document ?? NULL;
    }

    public function getChecklistDocumentStatus($checklist)
    {
        return $this->getChecklistDocument($checklist)->status ?? NULL;
    }

    public function getCheckedChecklistDocument($checklist, $checklistIds)
    {
        $checklist_document = $this->getChecklistDocument($checklist);

        return (in_array($checklist->id, $checklistIds) && !is_null($checklist_document->selected_at ?? NULL))
            ? "consent-card-active"
            : '';
    }

    /**
     * Saves date case submitted
     *
     * @param  \stdClass $feeInfo
     * @return bool
     */
    public function saveDateCaseSubmitted(\stdClass $document) : bool
    {
        $this->date_case_submitted        = $document->date_case_submitted;
        return $this->save();
    }
}
