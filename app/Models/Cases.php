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

    public function isSubmitted() : bool
    {
        return empty($this->submitted_at) ? false : true;
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

    public function getSubject($textStyle=NULL) : string
    {
        return textTransformer(shortenContent($this->subject, 35), $textStyle);
    }

    public function getCategory($textStyle=NULL) : string
    {
        return \AppHelper::value('case_categories', $this->case_category, $textStyle) ?? "";
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

    public function generateCasePartiesBadge($extraStyles='mr_10') : string
    {
        $styles = ['success', 'danger', 'warning', 'info', 'primary'];
        return $this->getCaseParties()->map(function($party) use ($styles, $extraStyles)
        {
            $style = $styles[rand(0, count($styles) - 1)];
            return "<span class='label label-lg font-weight-bold label-light-{$style} text-dark label-inline {$extraStyles}'>{$party}</span>";
        })->join(" ");
    }

    public function getApplicantName() : string
    {
        return trim($this->applicant_fullname);
    }

    public function getSubmittedAt(string $format='customdate') : string
    {
        return datetimeToText($this->submitted_at, $format);
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

    public function getCaseSubmittedChecklistByStatus(string $status=NULL)
    {
        $deficientChecklist = $this->getCaseSubmittedChecklist()->filter(function($checklistDocument) use (&$status)
        {
            return $checklistDocument->checklist_document->status == $status;
        });

        return $deficientChecklist->toArray();
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
}
