<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $guarded = [];

    /**
     * Get case
     *
     * @return HasRelationship
     */
    public function case()
    {
        return $this->hasOne(Cases::class, 'id', 'case_id');
    }

    /**
     * Get group
     *
     * @return HasRelationship
     */
    public function group()
    {
        return $this->belongsTo(ChecklistGroup::class, 'group_id');
    }

    /**
     * Get checklists
     *
     * @return HasRelationships
     */
    public function checklists()
    {
        return $this->belongsToMany(Checklist::class, 'checklist_document', 'document_id', 'checklist_id')
            ->withPivot('status', 'reason', 'selected_at')
            ->as('checklist_document')
            ->withTimestamps();
    }

    /**
     * Get icon text
     *
     * @return String
     */
    public function getIconText()
    {
        $extensions     = ['pdf' => 'pdf', 'doc' => 'doc', 'docx' => 'doc', 'csv' => 'csv', 'zip' => 'zip'];
        $path           = "/assets/backend/media/svg/";
        $fileExtension  = pathinfo($this->file)['extension'] ?? '';
        $extension      = $extensions[$fileExtension] ?? '';
        $file           = (in_array($fileExtension, array_keys($extensions))) ? "files/{$extension}.svg" : 'icons/Files/File.svg';
        return "{$path}{$file}";
    }

    /**
     * Get file icon text
     *
     * @param String $file
     * @return String
     */
    public function getFileIconText($file)
    {
        $extensions     = ['pdf' => 'pdf', 'doc' => 'doc', 'docx' => 'doc', 'csv' => 'csv', 'zip' => 'zip'];
        $path           = "/assets/backend/media/svg/";
        $fileExtension  = pathinfo($file)['extension'] ?? '';
        $extension      = $extensions[$fileExtension] ?? '';
        $file           = (in_array($fileExtension, array_keys($extensions))) ? "files/{$extension}.svg" : 'icons/Files/File.svg';
        return "{$path}{$file}";
    }

    /**
     * Get checklists
     *
     * @param String $replacement
     * @param bool $newline
     * @return String
     */
    public function getAdditionalInfo(string $replacement="...", $newline=true) : string
    {
        $additional_info = ($newline) ? nl2br($this->additional_info) : $this->additional_info;
        return empty($additional_info) ? $replacement : $additional_info;
    }

    /**
     * Get checklist document
     *
     * @param Object $checklist
     * @return Collection
     */
    public function getChecklistDocument($checklist)
    {
        $checklist_document = $this
                            ->checklists
                            ->where('id', $checklist->id)
                            ->first();

        return $checklist_document->checklist_document ?? NULL;
    }

    /**
     * Get checklist document status
     *
     * @param Object $checklist
     * @return String
     */
    public function getChecklistDocumentStatus($checklist)
    {
        return $this->getChecklistDocument($checklist)->status ?? NULL;
    }

    /**
     * Get checklist document reason
     *
     * @return String
     */
    public function getChecklistDocumentReason($checklist)
    {
        return $this->getChecklistDocument($checklist)->reason ?? NULL;
    }

    /**
     * Get file array
     *
     * @return Array
     */
    public function getFileArray() : array
    {
        return explode(',', $this->file);
    }

    /**
     * Get file label array
     *
     * @return Array
     */
    public function getFileLabelArray() : array
    {
        return explode(':', $this->label);
    }

    /**
     * Get document name
     *
     * @param int $file_count
     * @return string
     */
    public function getDocumentName(int $file_count) : string
    {
        // getFileLabelArray
        // $case
        // $key
        // Example: APP0526896D92 - This Executive Summary.pdf
        // MRR Form 1 Doc_1
        return ucfirst($this->group->name)." Doc_{$file_count}";
    }

    /**
     * Get document download link
     *
     * @param string $file
     * @return string
     */
    public function getDocumentLink(string $file) : string
    {
        return route('applicant.document.download', ['document' => $this->id, 'file' => $file]);
    }

    /**
     * Get checklists
     *
     * @param Object $checklist
     * @param Array $checklistIds
     * @return String
     */
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
        $this->date_case_submitted = $document->date_case_submitted;
        return $this->save();
    }
}
