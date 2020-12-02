<?php

namespace App\Models;

use App\Models\CaseTraits\CaseGettable;
use App\Models\CaseTraits\CaseSaveable;
use Illuminate\Database\Eloquent\Model;
use App\Models\CaseTraits\CaseAssignable;

class Cases extends Model
{
    use CaseSaveable, CaseGettable, CaseAssignable;

	protected $table = 'cases';

    protected $guarded = [];

    public function creator()
    {
        if (!empty($this->user_id))
            return $this->user();

        if (!empty($this->guest_id))
            return $this->guest();

        return false;
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'case_id');
    }

    public function isCategorySet() : bool
    {
        return empty($this->case_category) ? false : true;
    }

    public function isAssigned() : bool
    {
        return !empty($this->active_handlers->first()) ? true : false;
    }

    public function isSubmitted() : bool
    {
        return empty($this->submitted_at) ? false : true;
    }

    public function isDeficient()
    {
        $active_handler = $this->active_handlers[0] ?? NULL;

        if (is_null($active_handler)) return false;

        return is_null($active_handler->case_handler->defficiency_issued_at) ? false : true;
    }

    public function isCaseOnHold() : bool
    {
        return empty($this->getDefficiencyDate()) ? false : true;
    }

    public function isCaseChecklistsApproved() : bool
    {
        return empty($this->getChecklistApprovedDate()) ? false : true;
    }

    public function isRecommendationIssued() : bool
    {
        if (empty($this->getRecommendationIssuedDate()))
            return FALSE;

        if (empty($this->getRecommendation()))
            return FALSE;

        if (empty($this->getAnalysisDocument()))
            return FALSE;

        return TRUE;
    }

    public function getAmountPaid()
    {
        return (!empty($this->amount_paid) && $this->amount_paid != 'undefined') ? formatDigit($this->amount_paid) : '...';
    }

    public function selectedCategoryStyle($case_category='reg') : \stdClass
    {
        $case_category = strtoupper($case_category);
        return (object) [
            'bg'        => ($this->case_category == $case_category) ? 'bg-success' : '',
            'svg'       => ($this->case_category == $case_category) ? 'svg-icon-white' : 'svg-icon-primary',
            'text'      => ($this->case_category == $case_category) ? 'text-inverse-success' : 'text-dark',
            'textsm'    => ($this->case_category == $case_category) ? 'text-inverse-success' : 'text-muted text-hover-primary',
        ];
    }

    public function getRefNO($textStyle='strtoupper') : string
    {
        $refrenceNo = !empty($this->reference_number) ? "{$this->reference_number}" : '';
        return textTransformer($refrenceNo, $textStyle);
    }

    public function getLetterOfAppointmentIconText()
    {
        $extensions     = ['pdf' => 'pdf', 'doc' => 'doc', 'docx' => 'doc', 'csv' => 'csv', 'zip' => 'zip'];
        $path           = "/assets/backend/media/svg/";
        $fileExtension  = pathinfo($this->letter_of_appointment)['extension'] ?? '';
        $extension      = $extensions[$fileExtension] ?? '';
        $file           = (in_array($fileExtension, array_keys($extensions))) ? "files/{$extension}.svg" : 'icons/Files/File.svg';
        return "{$path}{$file}";
    }

    public function getApplicationFormIconText($form)
    {
        $extensions     = ['pdf' => 'pdf', 'doc' => 'doc', 'docx' => 'doc', 'csv' => 'csv', 'zip' => 'zip'];
        $path           = "/assets/backend/media/svg/";
        $fileExtension  = pathinfo($form)['extension'] ?? '';
        $extension      = $extensions[$fileExtension] ?? '';
        $file           = (in_array($fileExtension, array_keys($extensions))) ? "files/{$extension}.svg" : 'icons/Files/File.svg';
        return "{$path}{$file}";
    }

    public function getSubject($textStyle=NULL) : string
    {
        return textTransformer(shortenContent($this->subject, 35), $textStyle);
    }

    public function getCategory($textStyle=NULL) : string
    {
        return \AppHelper::value('case_categories', $this->case_category, $textStyle) ?? "";
    }

    public function getCategoryText($textStyle=NULL) : string
    {
        return \AppHelper::value('case_categories_text', $this->case_category, $textStyle) ?? "";
    }

    public function getCategoryHtml($textStyle=NULL) : string
    {
        $category       = $this->getCategory($textStyle);
        $categoryHtml   = \AppHelper::value('case_categories_html', $this->case_category, NULL) ?? "";
        return "<span class='label label-lg font-weight-bold label-inline label-light-{$categoryHtml}'>{$category}</span>";
    }

    public function getType($textStyle='ucfirst') : string
    {
        return \AppHelper::value('case_types', $this->case_type, $textStyle) ?? "";
    }

    public function getTypeHtml($textStyle='ucfirst') : string
    {
        $type       = $this->getType($textStyle);
        $typeHtml   = \AppHelper::value('case_types_html', $this->case_type, NULL) ?? "";
        return "<span class='label label-{$typeHtml} label-dot mr-2'></span>
                <span class='font-weight-bold text-{$typeHtml}'>{$type}</span>";
    }

    public function getCaseParties(bool $collect=true)
    {
        $parties = (empty($this->parties)) ? [] : explode(':', $this->parties);
        return ($collect) ? collect($parties) : $parties;
    }

    public function getCasePartiesText()
    {
        return implode(', ', $this->getCaseParties(false));
    }

    public function generateCasePartiesBadge($extraStyles='mr_10') : string
    {
        $styles = ['success', 'danger', 'warning', 'info', 'primary'];
        return $this->getCaseParties()->map(function($party) use ($styles, $extraStyles)
        {
            $style = $styles[rand(0, count($styles) - 1)];
            return "<span class='label label-lg font-weight-bold label-light-{$style} text-dark label-inline {$extraStyles}'>{$party}</span>";
        })->join(" ");
    }

    public function generateCasePartiesRadio($extraStyles='mr_10') : string
    {
        $styles = ['success', 'danger', 'warning', 'info', 'primary'];
        return $this->getCaseParties()->map(function($party) use ($styles, $extraStyles)
        {
            $style = $styles[rand(0, count($styles) - 1)];
            return "<span class='label label-{$style} label-dot mr-2'></span>
                <span class='font-weight-bold text-{$style} {$extraStyles}'>{$party}</span>";
        })->join(" ");
    }

    public function getApplicantName() : string
    {
        return trim($this->applicant_fullname);
    }

    public function getSubmittedAt(string $format='customdate') : string
    {
        return !empty($this->submitted_at) ? datetimeToText($this->submitted_at, $format) : "";
    }

    public function getDefficiencyIssuedAt(string $format='customdate') : string
    {
        $defficiency_issued_at = $this->case_handler->defficiency_issued_at;
        return !empty($defficiency_issued_at) ? datetimeToText($defficiency_issued_at, $format) : "";
    }

    public function getCaseSubmittedChecklist()
    {
        $checklistDocuments = [];
        $this->documents->map(function($document) use (&$checklistDocuments)
        {
            $checklistDocuments[] = $document->checklists;
        });
        return collect($checklistDocuments)->flatten();
    }

    public function getCaseSubmittedChecklistByStatus(string $status='deficient')
    {
        $deficientChecklist = $this->getCaseSubmittedChecklist()->filter(function($checklistDocument) use (&$status)
        {
            return (($checklistDocument->checklist_document->status == $status));
        });

        return $deficientChecklist;
    }

    public function getChecklistStatusCount() : array
    {
        return $this
            ->getCaseSubmittedChecklist()
            ->pluck('checklist_document')
            ->pluck('status')
            ->countBy()
            ->toArray();
    }

    public function getChecklistIds() : array
    {
        return $this
            ->getCaseSubmittedChecklist()
            ->pluck('id')
            ->toArray();
    }

    public function getDeficientGroupIds() : array
    {
        $newDeficientGroupIds = [];
        foreach ($this->getCaseSubmittedChecklistByStatus('deficient') as $key => $value) {
           $newDeficientGroupIds[$key] = $value->group_id;
        }

        return $newDeficientGroupIds;
    }

    public function getChecklistName() : array
    {
        return $this
            ->getCaseSubmittedChecklist()
            ->pluck('name')
            ->toArray();
    }

    public function getChecklistGroupDocuments() : array
    {
        $checklistGroupDocuments = [];
        $this->documents->map(function($document) use (&$checklistGroupDocuments)
        {
            $document->checklists->map(function($checklist) use ($document, &$checklistGroupDocuments)
            {
                $checklistGroupDocuments[$checklist->group->id] = $document;
            });
        });
        return $checklistGroupDocuments;
    }

    public function getChecklistGroupName() : array
    {
        $checklistGroupName = [];
        $this->documents->map(function($document) use (&$checklistGroupName)
        {
            $document->checklists->map(function($checklist) use ($document, &$checklistGroupName)
            {
                $checklistGroupName[$checklist->group->id] = $checklist->group->name;
            });
        });
        return $checklistGroupName;
    }

    public function unSubmittedDocuments()
    {
        return $this->documents()->where('date_case_submitted', null)->get();
    }

    public function submittedDocuments()
    {
        return $this
            ->documents()
            ->where('date_case_submitted', '!=', null)
            ->get()
            ->groupBy('date_case_submitted')
            ->sortKeysDesc();
    }

    public function getSubmittedDocumentByDate(string $date=NULL)
    {
        $submittedDocuments = $this->submittedDocuments();

        foreach ($submittedDocuments as $dateSubmitted => $documents)
        {
            foreach ($documents as $document)
            {
                $checklists = $document->checklists;
                $group      = $document->group;
            }
        }

        $submittedDocuments = $submittedDocuments->all();

        return ($submittedDocuments[$date] ?? NULL);
    }

    public function getSubmittedDocumentChecklistByDateAndStatus(string $date=NULL, string $status=NULL)
    {
        $submittedDocument = $this->getSubmittedDocumentByDate($date);

        return $submittedDocument
            ->pluck('checklists')
            ->flatten()
            ->filter()
            ->where('checklist_document.status', $status);
    }

    public function latestSubmittedDocuments()
    {
        return $this->submittedDocuments()->first();
    }

    public function getLatestSubmittedDocumentChecklists()
    {
        $checklistDocuments = [];
        $this->latestSubmittedDocuments()->map(function($document) use (&$checklistDocuments)
        {
            $checklistDocuments[] = $document->checklists;
        });
        return collect($checklistDocuments)->flatten();
    }

    public function getLatestSubmittedDocumentChecklistsByStatus(string $status="deficient")
    {
        $status = (in_array(strtolower($status), ['deficient', 'approved'])) ? $status : "deficient";
        return $this->getLatestSubmittedDocumentChecklists()
            ->filter(function($checklist, $key) use ($status)
            {
                return ($checklist->checklist_document->status == $status);
            });
    }

    public function getLatestSubmittedDocumentChecklistsIDs(string $status="deficient")
    {
        return $this->getLatestSubmittedDocumentChecklistsByStatus($status)->pluck('id')->toArray();
    }

    public function getLatestSubmittedDocumentChecklistsGroupIDs(string $status="deficient")
    {
        return $this
            ->getLatestSubmittedDocumentChecklistsByStatus($status)
            ->pluck('group_id')
            ->unique()
            ->values()
            ->toArray();
    }

    public function getLatestSubmittedDocumentChecklistsGroups(string $status="deficient")
    {
        $checklistGroups = [];
        $this->getLatestSubmittedDocumentChecklistsByStatus($status)->map(function($checklist) use (&$checklistGroups)
        {
            $checklistGroups[$checklist->group_id] = $checklist->group;
        });
        return collect($checklistGroups);
    }

    public function getLatestSubmittedDocumentChecklistsGroupNames(string $status="deficient")
    {
        return $this
            ->getLatestSubmittedDocumentChecklistsGroups($status)
            ->pluck('name')
            ->toArray();
    }

    public function getChecklistGroupUnSubmittedDocuments()
    {
        $checklistGroupDocuments = [];
        $this->unSubmittedDocuments()->map(function($document) use (&$checklistGroupDocuments)
        {
            $document->checklists->map(function($checklist) use ($document, &$checklistGroupDocuments)
            {
                $checklistGroupDocuments[$checklist->group->id] = $document;
            });
        });
        return $checklistGroupDocuments;
    }

    public function getChecklistGroupUnSubmittedDocumentsName() : array
    {
        $checklistGroupName = [];
        $this->unSubmittedDocuments()->map(function($document) use (&$checklistGroupName)
        {
            $document->checklists->map(function($checklist) use ($document, &$checklistGroupName)
            {
                $checklistGroupName[$checklist->group->id] = $checklist->group->name;
            });
        });
        return $checklistGroupName;
    }

    // ...
    public function getCaseStatus($textStyle='strtolower')
    {
        return \AppHelper::value('case_status', $this->status ?? 1, $textStyle);
    }

    public function getCaseStatusHTML($textStyle='strtolower')
    {
        return \AppHelper::value('case_status_html', $this->status ?? 1, $textStyle);
    }

    public function getCaseHandlerName() : string
    {
        return ($caseHandler = $this->handler->first()) ? $caseHandler->getFullName() : "";
    }

    /**
     * Get users full name
     *
     * @return string
     */
    public function getFullName() : string
    {
        return trim($this->first_name.' '.$this->last_name);
    }

    /**
     * Get handlers full name
     *
     * @return string
     */
    public function getHandlerFullName() : string
    {
        if ($this->active_handlers->first())
            return $this->active_handlers->first()->getFullName();

        return '...';
    }
}
