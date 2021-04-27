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

    /**
     * Get case creator
     *
     * @return mixed
     */
    public function creator()
    {
        if (!empty($this->user_id))
            return $this->user();

        if (!empty($this->guest_id))
            return $this->guest();

        return false;
    }

    /**
     * Get publication
     *
     * @return HasRelationship
     */
    public function publication()
    {
        return $this->hasOne(Publication::class, 'case_id');
    }

    /**
     * Get guest
     *
     * @return HasRelationship
     */
    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    /**
     * Get user
     *
     * @return HasRelationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get documents
     *
     * @return HasRelationships
     */
    public function documents()
    {
        return $this->hasMany(Document::class, 'case_id');
    }

    /**
     * Check if case category is set
     *
     * @return bool
     */
    public function isCategorySet() : bool
    {
        return empty($this->case_category) ? false : true;
    }

    /**
     * Check if case assigned
     *
     * @return bool
     */
    public function isAssigned() : bool
    {
        return !empty($this->active_handlers->first()) ? true : false;
    }

    /**
     * Check if case is submitted
     *
     * @return bool
     */
    public function isSubmitted() : bool
    {
        return empty($this->submitted_at) ? false : true;
    }

    /**
     * Check if case is deficient
     *
     * @return bool
     */
    public function isDeficient()
    {
        $active_handler = $this->active_handlers[0] ?? NULL;

        if (is_null($active_handler)) return false;

        return is_null($active_handler->case_handler->defficiency_issued_at) ? false : true;
    }

    /**
     * Check if case is being worked-on/ongoing
     *
     * @return bool
     */
    public function isOngoing()
    {
        $active_handler = $this->active_handlers[0] ?? NULL;

        if (is_null($active_handler)) return false;

        return is_null($active_handler->case_handler->workingon_at) ? false : true;
    }

    /**
     * Check if case is on hold
     *
     * @return bool
     */
    public function isCaseOnHold() : bool
    {
        return empty($this->getDefficiencyDate()) ? false : true;
    }

    /**
     * Check if case approval is requested
     *
     * @return bool
     */
    public function isApprovalRequested() : bool
    {
         $active_handler = $this->active_handlers[0] ?? NULL;

        if (is_null($active_handler)) return false;

        return is_null($active_handler->case_handler->approval_requested_at) ? false : true;
    }

    /**
     * Check if case checklist is approved
     *
     * @return bool
     */
    public function isCaseChecklistsApproved() : bool
    {
        return empty($this->getChecklistApprovedDate()) ? false : true;
    }

    /**
     * Check if case recommendation is issued
     *
     * @return bool
     */
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

    /**
     * Check if approval is rejected
     *
     * @return bool
     */
    public function checkApprovalRejection() : bool
    {
        if ($this->isApprovalRejected())
            return TRUE;

        return !$this->isRecommendationIssued();
    }

    /**
     * Check if case is closed
     *
     * @return string
     */
    public function caseClosedAt($format = 'customdate'){
        $active_handler = $this->active_handlers[0] ?? NULL;

        if (is_null($active_handler)) return false;

        return datetimeToText($active_handler->case_handler->approval_requested_at, $format);
    }

    /**
     * Check if approval request has been approved
     *
     * @return bool
     */
    public function checkApprovalApproved() : bool
    {
        if ($this->isApprovalApproved())
            return TRUE;

        return !$this->isRecommendationIssued();
    }

    /**
     * Check if approval request has been rejected
     *
     * @return bool
     */
    public function isApprovalRejected() : bool
    {
        $active_handler = $this->active_handlers[0] ?? NULL;

        if (is_null($active_handler)) return false;

        return ($active_handler->case_handler->approval_status == 'rejected') ? true : false;
    }

    /**
     * Check if logged in user is assigned to selected case
     *
     * @return bool
     */
    public function isActiveUsersCase() : bool
    {
        $active_handler = $this->active_handlers->first() ?? NULL;

        if (is_null($active_handler)) return false;

        return $active_handler->case_handler->handler_id == auth()->user()->id;
    }

    /**
     * Check if final approval has been issued and approved
     *
     * @return bool
     */
    public function isApprovalApproved() : bool
    {
        $active_handler = $this->active_handlers[0] ?? NULL;

        if (is_null($active_handler)) return false;

        return ($active_handler->case_handler->approval_status == 'approved') ? true : false;
    }

    /**
     * Check if approval letter has been sent
     *
     * @return bool
     */
    public function isApprovalLetterSent() : bool
    {
        $active_handler = $this->active_handlers[0] ?? NULL;

        if (is_null($active_handler)) return false;

        return ($active_handler->case_handler->approval_letter_sent_at == 'approved') ? true : false;
    }

    /**
     * Check if case has been archived
     *
     * @return bool
     */
    public function isCaseArchived() : bool
    {
        $active_handler = $this->active_handlers[0] ?? NULL;

        if (is_null($active_handler)) return false;

        return (!empty($active_handler->case_handler->archived_at)) ? true : false;
    }

    /**
     * Check if case is ongoing
     *
     * @return bool
     */
    public function isCaseOnGoing() : bool
    {
        $active_handler = $this->active_handlers[0] ?? NULL;

        if (is_null($active_handler)) return false;

        return (!empty($active_handler->case_handler->workingon_at)) ? true : false;
    }

    /**
     * Check approval status
     *
     * @return bool
     */
    public function checkApprovalStatus() : bool
    {
        $active_handler = $this->active_handlers[0] ?? NULL;

        if (is_null($active_handler)) return false;

        return (!empty($active_handler->case_handler->approval_status)) ? true : false;
    }

    /**
     * Get case handler
     *
     * @return object
     */
    public function getHandler()
    {
        $active_handler = $this->active_handlers[0] ?? NULL;

        if (is_null($active_handler)) return false;

        return $active_handler;
    }

    /**
     * Get case application fee
     *
     * @return integer
     */
    public function getApplicationFee()
    {
        return (!empty($this->application_fee) && $this->application_fee != 'undefined') ? formatDigit($this->application_fee) : '₦0.00';
    }

    /**
     * Get case processing fee
     *
     * @return integer
     */
    public function getProcessingFee()
    {
        return (!empty($this->processing_fee) && $this->processing_fee != 'undefined') ? formatDigit($this->processing_fee) : '₦0.00';
    }

    /**
     * Get expedited fee
     *
     * @return integer
     */
    public function getExpeditedFee()
    {
        return (!empty($this->expedited_fee) && $this->expedited_fee != 'undefined') ? formatDigit($this->expedited_fee) : '₦0.00';
    }

    /**
     * Get amount paid
     *
     * @return integer
     */
    public function getAmountPaid()
    {
        return (!empty($this->amount_paid) && $this->amount_paid != 'undefined') ? formatDigit($this->amount_paid) : '₦0.00';
    }

    /**
     * Get applicant full name
     *
     * @return String
     */
    public function getApplicantFullName()
    {
        return (!empty($this->applicant_fullname)) ? $this->applicant_fullname : '...';
    }

    /**
     * Get application status
     *
     * @return String
     */
    public function getApplicationStatus() : string
    {
        if ($this->isCaseArchived())
            return "It has been <span class='text-danger'>ARCHIVED</span>";

        if ($this->isApprovalApproved())
            return "It has been <span class='text-primary'>APPROVED</span>";

        if ($this->isCaseOnGoing())
            return "It is being <span class='text-warning'>WORKED ON</span>";

        if ($this->isAssigned())
            return "It has been <span class='text-success'>ASSIGNED</span>";

        return "It has been <span class='text-primary'>RECEIVED</span>";
    }

    /**
     * Get selected category style
     *
     * @return String
     */
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

    /**
     * Get reference no
     *
     * @return String
     */
    public function getRefNO($textStyle='strtoupper') : string
    {
        $refrenceNo = !empty($this->reference_number) ? "{$this->reference_number}" : '';
        return textTransformer($refrenceNo, $textStyle);
    }

    /**
     * Get form1A icon text
     *
     * @return String
     */
    public function getForm1AIconText()
    {
        $extensions     = ['pdf' => 'pdf', 'doc' => 'doc', 'docx' => 'doc', 'csv' => 'csv', 'zip' => 'zip'];
        $path           = "/assets/backend/media/svg/";
        $fileExtension  = pathinfo($this->form_1A)['extension'] ?? '';
        $extension      = $extensions[$fileExtension] ?? '';
        $file           = (in_array($fileExtension, array_keys($extensions))) ? "files/{$extension}.svg" : 'icons/Files/File.svg';
        return "{$path}{$file}";
    }

    /**
     * Get letter of appointment text
     *
     * @return String
     */
    public function getLetterOfAppointmentIconText()
    {
        $extensions     = ['pdf' => 'pdf', 'doc' => 'doc', 'docx' => 'doc', 'csv' => 'csv', 'zip' => 'zip'];
        $path           = "/assets/backend/media/svg/";
        $fileExtension  = pathinfo($this->letter_of_appointment)['extension'] ?? '';
        $extension      = $extensions[$fileExtension] ?? '';
        $file           = (in_array($fileExtension, array_keys($extensions))) ? "files/{$extension}.svg" : 'icons/Files/File.svg';
        return "{$path}{$file}";
    }

    /**
     * Check if case category is set
     *
     * @param String $form
     * @return String
     */
    public function getApplicationFormIconText($form)
    {
        $extensions     = ['pdf' => 'pdf', 'doc' => 'doc', 'docx' => 'doc', 'csv' => 'csv', 'zip' => 'zip'];
        $path           = "/assets/backend/media/svg/";
        $fileExtension  = pathinfo($form)['extension'] ?? '';
        $extension      = $extensions[$fileExtension] ?? '';
        $file           = (in_array($fileExtension, array_keys($extensions))) ? "files/{$extension}.svg" : 'icons/Files/File.svg';
        return "{$path}{$file}";
    }

    /**
     * Check if case category is set
     *
     * @param String $textStyle
     * @return String
     */
    public function getSubject($textStyle=NULL) : string
    {
        return textTransformer(shortenContent($this->subject, 35), $textStyle);
    }

    /**
     * Get case category array key
     *
     * @return string
     */
    public function getCategoryKey() : string
    {
        return$this->case_category ?? "";
    }

    /**
     * Get case category array value
     *
     * @param String $textStyle
     * @return bool
     */
    public function getCategory($textStyle=NULL) : string
    {
        return \AppHelper::value('case_categories', $this->case_category, $textStyle) ?? "";
    }

    /**
     * Get category text
     *
     * @param String $textStyle
     * @return String
     */
    public function getCategoryText($textStyle=NULL) : string
    {
        return \AppHelper::value('case_categories_text', $this->case_category, $textStyle) ?? "";
    }

    /**
     * Get categroy html string text
     *
     * @param String $textStyle
     * @return String
     */
    public function getCategoryHtml($textStyle=NULL) : string
    {
        $category       = $this->getCategory($textStyle);
        $categoryHtml   = \AppHelper::value('case_categories_html', $this->case_category, NULL) ?? "";
        return "<span class='label label-lg font-weight-bold label-inline label-light-{$categoryHtml}'>{$category}</span>";
    }

    /**
     * Get case type
     *
     * @param String $textStyle
     * @return String
     */
    public function getType($textStyle='ucfirst') : string
    {
        return \AppHelper::value('case_types', $this->case_type, $textStyle) ?? "";
    }

    /**
     * Get case type html text
     *
     * @param String $textStyle
     * @return String
     */
    public function getTypeHtml($textStyle='ucfirst') : string
    {
        $type       = $this->getType($textStyle);
        $typeHtml   = \AppHelper::value('case_types_html', $this->case_type, NULL) ?? "";
        return "<span class='label label-{$typeHtml} label-dot mr-2'></span>
                <span class='font-weight-bold text-{$typeHtml}'>{$type}</span>";
    }

    /**
     * Get case parties
     *
     * @param Bool $collect
     * @return Collection
     */
    public function getCaseParties(bool $collect=true)
    {
        $parties = (empty($this->parties)) ? [] : explode(':', $this->parties);
        return ($collect) ? collect($parties) : $parties;
    }

    /**
     * Get case parties text
     *
     * @return Array
     */
    public function getCasePartiesText()
    {
        return implode(', ', $this->getCaseParties(false));
    }

    /**
     * Get case parties publication
     *
     * @return Array
     */
    public function getCasePartiesPublication()
    {
        return implode('/', $this->getCaseParties(false));
    }

    /**
     * Generate case parties badge
     *
     * @param String $textStyles
     * @return String
     */
    public function generateCasePartiesBadge($extraStyles='mr_10') : string
    {
        $styles = ['success', 'danger', 'warning', 'info', 'primary'];
        return $this->getCaseParties()->map(function($party) use ($styles, $extraStyles)
        {
            $style = $styles[rand(0, count($styles) - 1)];
            return "<span class='label label-lg font-weight-bold label-light-{$style} text-dark label-inline {$extraStyles}'>{$party}</span>";
        })->join(" ");
    }

    /**
     * Generate case parties radio
     *
     * @param String $extraStyles
     * @return String
     */
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

    /**
     * Get applicant name
     *
     * @return String
     */
    public function getApplicantName() : string
    {
        return trim($this->applicant_fullname);
    }

    /**
     * Get submitted at
     *
     * @return String
     */
    public function getSubmittedAt(string $format='customdate') : string
    {
        return !empty($this->submitted_at) ? datetimeToText($this->submitted_at, $format) : "";
    }

    /**
     * Get form 1A date
     *
     * @return String
     */
    public function getForm1ADate(string $format='customdate') : string
    {
        return !empty($this->form_1A_Date) ? datetimeToText($this->form_1A_Date, $format) : "";
    }

    /**
     * Get deficiency issued at
     *
     * @return String
     */
    public function getDefficiencyIssuedAt(string $format='customdate') : string
    {
        $defficiency_issued_at = $this->case_handler->defficiency_issued_at;
        return !empty($defficiency_issued_at) ? datetimeToText($defficiency_issued_at, $format) : "";
    }

    /**
     * Get submitted checklists
     *
     * @return Collection
     */
    public function getCaseSubmittedChecklist()
    {
        $checklistDocuments = [];
        $this->documents->map(function($document) use (&$checklistDocuments)
        {
            $checklistDocuments[] = $document->checklists;
        });
        return collect($checklistDocuments)->flatten();
    }

    /**
     * Get case submitted checklist by status
     *
     * @param String $status
     * @return bool
     */
    public function getCaseSubmittedChecklistByStatus(string $status='deficient')
    {
        $deficientChecklist = $this->getCaseSubmittedChecklist()->filter(function($checklistDocument) use (&$status)
        {
            return (($checklistDocument->checklist_document->status == $status));
        });

        return $deficientChecklist;
    }

    /**
     * Get deficiency info comment
     *
     * @return bool
     */
    public function getDefficientInfo()
    {
        $defficiency = $this->active_handlers->first()->case_handler->defficiency;
        return !(empty($defficiency)) ? $defficiency : '';
    }

    /**
     * Get checklist status count
     *
     * @return Array
     */
    public function getChecklistStatusCount() : array
    {
        return $this
            ->getCaseSubmittedChecklist()
            ->pluck('checklist_document')
            ->pluck('status')
            ->countBy()
            ->toArray();
    }

    /**
     * Get checklist id's
     *
     * @return Array
     */
    public function getChecklistIds() : array
    {
        return $this
            ->getCaseSubmittedChecklist()
            ->pluck('id')
            ->toArray();
    }

    /**
     * Get deficient group Id's
     *
     * @return Array
     */
    public function getDeficientGroupIds() : array
    {
        $newDeficientGroupIds = [];
        foreach ($this->getCaseSubmittedChecklistByStatus('deficient') as $key => $value) {
           $newDeficientGroupIds[$key] = $value->group_id;
        }

        return $newDeficientGroupIds;
    }

    /**
     * Get checklist name
     *
     * @return Array
     */
    public function getChecklistName() : array
    {
        return $this
            ->getCaseSubmittedChecklist()
            ->pluck('name')
            ->toArray();
    }

    /**
     * Get checklist group documents
     *
     * @return Array
     */
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

    /**
     * Get checklist group name
     *
     * @return Array
     */
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

    /**
     * Get unsubmitted documents
     *
     * @return Collection
     */
    public function unSubmittedDocuments()
    {
        return $this->documents()->where('date_case_submitted', null)->get();
    }

    /**
     * Get complete documents submitted
     *
     * @param String $case_category
     * @return Collection
     */
    public function submittedDocumentsComplete($case_category = NULL)
    {
        return $this
            ->documents()
            ->where('post_checklist', NULL)
            ->where('date_case_submitted', '!=', null)
            ->get()
            ->reject(function($document) use (&$case_category)
            {
                return $document->group->category !== $case_category && $document->group->category !== "ALL";
            })
            ->groupBy('date_case_submitted')
            ->sortKeysDesc();
    }

    /**
     * Get submitted post documents complete after documentation has been approved
     *
     * @param String $case_category
     * @return bool
     */
    public function submittedPostDocumentsComplete($case_category = NULL)
    {
        return $this
            ->documents()
            ->where('post_checklist', 1)
            ->where('date_case_submitted', '!=', null)
            ->get()
            ->reject(function($document) use (&$case_category)
            {
                return $document->group->category !== $case_category && $document->group->category !== "ALL";
            })
            ->groupBy('date_case_submitted')
            ->sortKeysDesc();
    }

    /**
     * Get submitted documents
     *
     * @param String $case_category
     * @return bool
     */
    public function submittedDocuments($case_category = NULL)
    {
        return $this
            ->documents()
            ->where('date_case_submitted', '!=', null)
            ->get()
            ->groupBy('date_case_submitted')
            ->sortKeysDesc();
    }

    /**
     * Get submitted documents by date
     *
     * @param String $date
     * @param String $case_category
     * @return mixed
     */
    public function getSubmittedDocumentByDate(string $date=NULL, string $case_category)
    {
        $submittedDocuments = $this->submittedDocuments($case_category);

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

    /**
     * Get submitted documents by date and status
     *
     * @param String $date
     * @param String $status
     * @param String $case_category
     * @return Collection
     */
    public function getSubmittedDocumentChecklistByDateAndStatus(string $date=NULL, string $status=NULL, string $case_category)
    {
        $submittedDocument = $this->getSubmittedDocumentByDate($date, $case_category);

        return $submittedDocument
            ->pluck('checklists')
            ->flatten()
            ->filter()
            ->where('checklist_document.status', $status);
    }

    /**
     * Get latest submitted documents
     *
     * @return Collection
     */
    public function latestSubmittedDocuments()
    {
        return $this->submittedDocuments()->first();
    }

    /**
     * Get latest submitted document checklists
     *
     * @return Collection
     */
    public function getLatestSubmittedDocumentChecklists()
    {
        $checklistDocuments = [];
        $this->latestSubmittedDocuments()->map(function($document) use (&$checklistDocuments)
        {
            $checklistDocuments[] = $document->checklists;
        });
        return collect($checklistDocuments)->flatten();
    }

    /**
     * Get latest submitted document checklist by status
     *
     * @param String $status
     * @return Collection
     */
    public function getLatestSubmittedDocumentChecklistsByStatus(string $status="deficient")
    {
        $status = (in_array(strtolower($status), ['deficient', 'approved'])) ? $status : "deficient";
        return $this->getLatestSubmittedDocumentChecklists()
            ->filter(function($checklist, $key) use ($status)
            {
                return ($checklist->checklist_document->status == $status);
            });
    }

    /**
     * Check if case category is set
     *
     * @return bool
     */
    public function getLatestSubmittedDocumentChecklistsIDs(string $status="deficient")
    {
        return $this->getLatestSubmittedDocumentChecklistsByStatus($status)->pluck('id')->toArray();
    }

    /**
     * Get latest submitted document checklists groupd IDs
     *
     * @param String $status
     * @return Collection
     */
    public function getLatestSubmittedDocumentChecklistsGroupIDs(string $status="deficient")
    {
        return $this
            ->getLatestSubmittedDocumentChecklistsByStatus($status)
            ->pluck('group_id')
            ->unique()
            ->values()
            ->toArray();
    }

    /**
     * Get latest submitted documents checklists groups
     *
     * @param String $status
     * @return Collection
     */
    public function getLatestSubmittedDocumentChecklistsGroups(string $status="deficient")
    {
        $checklistGroups = [];
        $this->getLatestSubmittedDocumentChecklistsByStatus($status)->map(function($checklist) use (&$checklistGroups)
        {
            $checklistGroups[$checklist->group_id] = $checklist->group;
        });
        return collect($checklistGroups);
    }

    /**
     * Get latest submitted documents checklists group names
     *
     * @param String $status
     * @return Collection
     */
    public function getLatestSubmittedDocumentChecklistsGroupNames(string $status="deficient")
    {
        return $this
            ->getLatestSubmittedDocumentChecklistsGroups($status)
            ->pluck('name')
            ->toArray();
    }

    /**
     * Get checklist group unsubmitted documents
     *
     * @return Array
     */
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

    /**
     * Get checklist group unsubmitted documents name
     *
     * @return Array
     */
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

    /**
     * Get applicant forms
     *
     * @return Array
     */
    public function getApplicationForms() : array
    {
        return explode(',', $this->application_forms);
    }

    /**
     * Get application forms formatted
     *
     * @return Array
     */
    public function formatApplicationForms() : array
    {
        $formObjects = [];
        foreach ($this->getApplicationForms() as $key => $form)
        {
            $key                = explode(':', $form)[0];
            $formObjects[$key]  = getApplicationFormObject($form);
        }
        return $formObjects;
    }

    /**
     * Merge application forms
     *
     * @param String $newForm
     * @return String
     */
    public function mergeApplicationForms(string $newForm) : string
    {
        list($newKey, $newFile)         = explode(':', $newForm);
        $formatedApplicationforms       = $this->formatApplicationForms();
        if (isset($formatedApplicationforms[$newKey])):
            $newApplicationForms        = [];
            foreach ($this->getApplicationForms() as $application_form)
            {
                list($key, $file)       = explode(':', $application_form);
                $newApplicationForms[]  = ($key != $newKey) ? $application_form : $newForm;
            }
            $newApplicationForms        = implode(",", $newApplicationForms);
        else:
            $applicationForms           = empty($this->getApplicationForms())
                                        ? [$newForm]
                                        : array_merge($this->getApplicationForms(), [$newForm]);
            $newApplicationForms        = implode(",", $applicationForms);
        endif;
        return $newApplicationForms;
    }

    /**
     * Get publication text
     *
     * @param Bool $escape_html_entity
     * @return String
     */
    public function getPublicationText(bool $escape_html_entity=FALSE)
    {
        $publicationText = $this->publication->text ?? $this->form_1A_Text;
        return ($escape_html_entity) ? html_entity_decode($publicationText) : $publicationText;
    }

    /**
     * Get status
     *
     * @param String $textStyle
     * @return String
     */
    public function getCaseStatus($textStyle='strtolower')
    {
        return \AppHelper::value('case_status', $this->status ?? 1, $textStyle);
    }

    /**
     * Get status html
     *
     * @param String $textStyle
     * @return String
     */
    public function getCaseStatusHTML($textStyle='strtolower')
    {
        return \AppHelper::value('case_status_html', $this->status ?? 1, $textStyle);
    }

    /**
     * Get case handler name
     *
     * @return String
     */
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
     * Get Form 1A set status
     *
     * @return bool
     */
    public function isForm1ASet() : bool
    {
        return (!empty($this->form_1A_text) || !empty($this->form_1A_Name) || !empty($this->form_1A_Position)) ? true : false;
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

    /**
     * Get handlers account type
     *
     * @return string
     */
    public function getHandlerAccountType() : string
    {
        if ($this->active_handlers->first())
            return $this->active_handlers->first()->getAccountType();

        return '...';
    }

    /**
     * Get handler id
     *
     * @return string
     */
    public function getHandlerId()
    {
        if ($this->active_handlers->first())
            return $this->active_handlers->first()->id;

        return '';
    }

    /**
     * Generate form 1A download link
     *
     * @return string
     */
    public function generateForm1ALink()
    {
        return $this->subject.'_Form1A'.'_'.now().'.pdf';
    }

    /**
     * Validate application documents
     *
     * @return json
     */
    public function validateDocuments()
    {
        foreach(\App\Models\ChecklistGroup::whereIn('category', ['ALL', $this->case_category])->get() as $checklistGroup):
                $document = \App\Models\Document::where('case_id', $this->id)
                                ->where('group_id', $checklistGroup->id)
                                ->where('date_case_submitted', null)
                                ->first() ?? '';
                if (!$document)
                    $this->sendResponse('Provide required documents.', 'error');
        endforeach;
    }
    /**
     * Validate application submission
     *
     * @return json
     */
    public function validateSubmission()
    {
        $case_parties = count(explode(':', $this->parties));

        if (
            empty($this->subject) ||
            empty($this->parties) ||
            empty($this->case_category) ||
            empty($this->case_type) ||
            empty($this->applicant_firm) ||
            empty($this->applicant_fullname) ||
            empty($this->applicant_email) ||
            empty($this->applicant_phone_number) ||
            empty($this->applicant_address) ||
            empty($this->amount_paid)
        ):
            $this->sendResponse('Provide required fields.', 'error');
        endif;

        if ($case_parties < 2)
            $this->sendResponse('Minimum of two parties required..', 'error');

        if(!$this->validatePhoneNumber())
            $this->sendResponse('Provide valid phone number.', 'error');

        if (
            ($this->case_category == 'REG' || $this->case_category == 'FFM') &&
            (empty($this->form_1A_Text) ||
            empty($this->form_1A_Name) ||
            empty($this->form_1A_Position))
        ):
            $this->sendResponse('Provide required Form 1A fields.', 'error');
        endif;

        $this->validateDocuments();
    }

    /**
     * Validate deficient application submission
     *
     * @return json
     */
    public function validateDeficientSubmission()
    {
        $deficientGroupIds      = $this->getLatestSubmittedDocumentChecklistsGroupIDs('deficient');

        foreach(\App\Models\ChecklistGroup::with('checklists')->get() as $checklistGroup):
            if($this->isCaseChecklistsApproved()):
                if($this->getCategoryKey() == $checklistGroup->category):
                    $document = \App\Models\Document::where('case_id', $this->id)
                                            ->where('group_id', $checklistGroup->id)
                                            ->where('date_case_submitted', null)
                                            ->first() ?? '';
                            if (!$document)
                                $this->sendResponse('Provide required documents.', 'error');
                endif;
            else:
                    if ((in_array($checklistGroup->id, $deficientGroupIds))):
                            $document = \App\Models\Document::where('case_id', $this->id)
                                            ->where('group_id', $checklistGroup->id)
                                            ->where('date_case_submitted', null)
                                            ->first() ?? '';
                            if (!$document)
                                $this->sendResponse('Provide required documents.', 'error');
                    endif;
            endif;
        endforeach;
    }

    /**
     * Validate phone number
     *
     * @return json
     */
    public function validatePhoneNumber()
    {
        if (empty($this->applicant_phone_number))
            return false;

        if (!is_numeric($this->applicant_phone_number))
            return false;

        if (strlen($this->applicant_phone_number) != 7 && strlen($this->applicant_phone_number) != 11)
            return false;

        return true;
    }

    /**
     * Get Approval Template Title
     *
     * @param int $template_id
     * @return string
     */
    public function getApprovalLetterTitle($template_id)
    {
        $title = "APPROVAL";

        if ($template_id == 1):
            $title = "APPROVAL";
        elseif ($template_id == 2):
            $title = "CONDITIONAL APPROVAL";
        elseif ($template_id == 3):
            $title = "NOTIFICATION OF SUBSTANTIAL COMPETITION CONCERNS";
        endif;

        return $title;
    }

    /**
     * Get Approval Template Officer
     *
     * @param int $template_id
     * @return string
     */
    public function getApprovalLetterOfficer($template_id)
    {
        $officer = "For: Executive Vice Chairman.";

        if ($template_id == 1)
            $officer = "For: Chief Executive Officer.";

        return $officer;
    }

    /**
     * Send response.
     *
     * @param string $message
     * @param string $responseType
     * @param mixed $response
     * @return void
     */
    public function sendResponse(
        string $message,
        string $responseType,
        $response = null
    ) {
        echo json_encode([
            'message' => $message,
            'responseType' => $responseType,
            'response' => $response,
        ]);
        exit();
    }
}
