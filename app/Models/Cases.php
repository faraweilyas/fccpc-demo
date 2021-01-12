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

    public function isApprovalRequested() : bool
    {
         $active_handler = $this->active_handlers[0] ?? NULL;

        if (is_null($active_handler)) return false;

        return is_null($active_handler->case_handler->approval_requested_at) ? false : true;
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

    public function checkApprovalRejection() : bool
    {
        if ($this->isApprovalRejected())
            return TRUE;

        return !$this->isRecommendationIssued();
    }

    public function checkApprovalApproved() : bool
    {
        if ($this->isApprovalApproved())
            return TRUE;

        return !$this->isRecommendationIssued();
    }

    public function isApprovalRejected() : bool
    {
        $active_handler = $this->active_handlers[0] ?? NULL;

        if (is_null($active_handler)) return false;

        return ($active_handler->case_handler->approval_status == 'rejected') ? true : false;
    }

    public function isApprovalApproved() : bool
    {
        $active_handler = $this->active_handlers[0] ?? NULL;

        if (is_null($active_handler)) return false;

        return ($active_handler->case_handler->approval_status == 'approved') ? true : false;
    }

    public function isCaseArchived() : bool
    {
        $active_handler = $this->active_handlers[0] ?? NULL;

        if (is_null($active_handler)) return false;

        return (!empty($active_handler->case_handler->archived_at)) ? true : false;
    }

    public function isCaseOnGoing() : bool
    {
        $active_handler = $this->active_handlers[0] ?? NULL;

        if (is_null($active_handler)) return false;

        return (!empty($active_handler->case_handler->workingon_at)) ? true : false;
    }

    public function checkApprovalStatus() : bool
    {
        $active_handler = $this->active_handlers[0] ?? NULL;

        if (is_null($active_handler)) return false;

        return (!empty($active_handler->case_handler->approval_status)) ? true : false;
    }

    public function getApplicationFee()
    {
        return (!empty($this->application_fee) && $this->application_fee != 'undefined') ? formatDigit($this->application_fee) : '₦0.00';
    }

    public function getProcessingFee()
    {
        return (!empty($this->processing_fee) && $this->processing_fee != 'undefined') ? formatDigit($this->processing_fee) : '₦0.00';
    }

    public function getExpeditedFee()
    {
        return (!empty($this->expedited_fee) && $this->expedited_fee != 'undefined') ? formatDigit($this->expedited_fee) : '₦0.00';
    }

    public function getAmountPaid()
    {
        return (!empty($this->amount_paid) && $this->amount_paid != 'undefined') ? formatDigit($this->amount_paid) : '₦0.00';
    }

    public function getApplicantFullName()
    {
        return (!empty($this->applicant_fullname)) ? $this->applicant_fullname : '...';
    }

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

    public function getForm1AIconText()
    {
        $extensions     = ['pdf' => 'pdf', 'doc' => 'doc', 'docx' => 'doc', 'csv' => 'csv', 'zip' => 'zip'];
        $path           = "/assets/backend/media/svg/";
        $fileExtension  = pathinfo($this->form_1A)['extension'] ?? '';
        $extension      = $extensions[$fileExtension] ?? '';
        $file           = (in_array($fileExtension, array_keys($extensions))) ? "files/{$extension}.svg" : 'icons/Files/File.svg';
        return "{$path}{$file}";
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

    public function getForm1ADate(string $format='customdate') : string
    {
        return !empty($this->form_1A_Date) ? datetimeToText($this->form_1A_Date, $format) : "";
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

    public function submittedDocumentsComplete($case_category = NULL)
    {
        return $this
            ->documents()
            ->where('date_case_submitted', '!=', null)
            ->get()
            ->reject(function($document) use (&$case_category)
            {
                return $document->group->category !== $case_category && $document->group->category !== "ALL";
            })
            ->groupBy('date_case_submitted')
            ->sortKeysDesc();
    }

    public function submittedDocuments($case_category = NULL)
    {
        return $this
            ->documents()
            ->where('date_case_submitted', '!=', null)
            ->get()
            ->groupBy('date_case_submitted')
            ->sortKeysDesc();
    }

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

    public function getSubmittedDocumentChecklistByDateAndStatus(string $date=NULL, string $status=NULL, string $case_category)
    {
        $submittedDocument = $this->getSubmittedDocumentByDate($date, $case_category);

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

    public function getApplicationForms() : array
    {
        return explode(',', $this->application_forms);
    }

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

        $this->validateDocuments();

        if (
            ($this->case_category == 'REG' || $this->case_category == 'FFM') &&
            (empty($this->form_1A_Text) ||
            empty($this->form_1A_Name) ||
            empty($this->form_1A_Position))
        ):
            $this->sendResponse('Provide required fields.', 'error');
        endif;

        if ($case_parties < 2)
            $this->sendResponse('Minimum of two parties required..', 'error');

        if (
            empty($this->subject) ||
            empty($this->parties) ||
            empty($this->case_category) ||
            empty($this->case_type) ||
            empty($this->applicant_firm) ||
            empty($this->applicant_fullname) ||
            empty($this->applicant_email) ||
            empty($this->applicant_phone_number) ||
            empty($this->applicant_address)
        ):
            $this->sendResponse('Provide required fields.', 'error');
        endif;
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
                if ((in_array($checklistGroup->id, $deficientGroupIds))):
                        $document = \App\Models\Document::where('case_id', $this->id)
                                        ->where('group_id', $checklistGroup->id)
                                        ->where('date_case_submitted', null)
                                        ->first() ?? '';
                        if (!$document)
                            $this->sendResponse('Provide required documents.', 'error');
                endif;
        endforeach;
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
