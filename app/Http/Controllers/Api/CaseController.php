<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Models\User;
use App\Models\Cases;
use App\Models\Document;
use App\Notifications\CaseAssigned;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiResponseTrait;

class CaseController extends Controller
{
    use ApiResponseTrait;

    /**
     * Get unassigned cases.
     *
     * @return json
     */
    public function getUnassignedCases()
    {
        return $this->sendResponse(200, 'success', 'Unassigned cases resolved!', [
        		'cases' => (new Cases)->unassignedCases(),
	        ]);
	}

	/**
     * Get all assigned cases.
     *
     * @return json
     */
    public function getAllAssignedCases()
    {
        $user        = JWTAuth::parseToken()->authenticate();
        $cases       = (new Cases)->assignedCases();
        if ($user->account_type == "CH"):
            $cases       = $user->active_cases_assigned_to()->get();
        endif;
        return $this->sendResponse(200, 'success', 'All assigned cases resolved!', [
        		'cases' => $cases,
	        ]);
	}

    /**
     * Get all case handlers.
     *
     * @return json
     */
    public function getCaseHandlers()
    {
        return $this->sendResponse(200, 'success', 'Case Handlers Resolved!', [
                'handlers' => (new User)->caseHandlers(),
            ]);
    }

	/**
     * Get case handler assigned cases.
     *
     * @return json
     */
    public function getCaseHandlerAssignedCases(User $handler)
    {
        $cases       = $handler->active_cases_assigned_to()->get();
        return $this->sendResponse(200, 'success', 'Case handler\'s assigned cases resolved!', [
        		'cases' => $cases,
	        ]);
	}

	/**
     * Assign case.
     *
     * @return json
     */
    public function assignCase()
    {
        $case    = Cases::find(request('case_id'));
        $handler = User::find(request('handler_id'));
        $case->assign($handler);

        $handler->notify(
            new CaseAssigned()
        );

        return $this->sendResponse(200, "Case assigned.", "success", [
            'case'      => $case,
            'handler'   => $handler
        ]);
    }

    /**
     * Unassign case.
     *
     * @return json
     */
    public function unassignCase()
    {
        $case    = Cases::find(request('case_id'));
        $handler = User::find(request('handler_id'));
    	$case->disolve($handler);
    	return $this->sendResponse(200, "Case unassigned.", "success", [
            'case'          => $case,
            'case_handler'  => $handler
        ]);
    }

    /**
     * Re-assign case.
     *
     * @return json
     */
    public function reAssignCase()
    {
        $case             = Cases::find(request('case_id'));
        $previous_handler = User::find(request('previous_handler_id'));
        $new_handler      = User::find(request('new_handler_id'));
    	$case->reAssign($previous_handler, $new_handler);

        $new_handler->notify(
            new CaseAssigned()
        );

    	return $this->sendResponse(200, "Case reassigned.", "success", [
            'case'                   => $case,
            'previous_case_handler'  => $previous_handler,
            'new_handler'            => $new_handler
        ]);
    }

    /**
     * Update document checklist status.
     *
     * @param Document $document
     * @return json
     */
    public function updateDocumentChecklistStatus(Document $document)
    {
        $case       = $document->case;
        $checklist  = request('checklist');
        $document->checklists()->syncWithoutDetaching([$checklist => ['status' => request('status')]]);
        return $this->sendResponse(200, "Checklist document updated", "success", [
            'case_group_documents' => $case->getChecklistGroupDocuments()
        ]);
    }

    /**
     * Get case details.
     *
     * @param Cases $case
     * @return json
     */
    public function getCase(Cases $case)
    {
    	return $this->sendResponse(200, "Case resolved.", "success", [
    		'case' => $case
    	]);
    }

    /**
     * Get case by type.
     *
     * @param Cases $case
     * @param string $case_type
     * @return json
     */
    public function getCaseByType(Cases $case, $case_type)
    {
    	return $this->sendResponse(200, "Cases resolved.", "success", [
    		'cases' => $case->filterCasesByType($case_type)
    	]);
    }

    /**
     * Get case by category.
     *
     * @param Cases $case
     * @param string $case_category
     * @return json
     */
    public function getCaseByCategory(Cases $case, $case_category)
    {
        return $this->sendResponse(200, "Cases resolved.", "success", [
            'cases' => $case->filterCasesByCategory($case_category)
        ]);
    }

    /**
     * Get case checklists.
     *
     * @param Cases $case
     * @return json
     */
    public function getCaseChecklists(Cases $case)
    {
    	return $this->sendResponse(200, "Case checklists resolved.", "success", [
    		'checklists' => $case->getChecklistName()
    	]);
    }

    /**
     * Get case documents.
     *
     * @param Cases $case
     * @return json
     */
    public function getCaseDocuments(Cases $case)
    {
    	return $this->sendResponse(200, "Case documents resolved.", "success", [
    		'documents'   => $case->getChecklistGroupDocuments(),
    		'group'       => $case->getChecklistGroupName()
    	]);
    }

    /**
     * Get dashboard reports.
     *
     * @return json
     */
    public function getDashboardReports()
    {
        return $this->sendResponse(200, "Case handlers report resolved.", "success", [
            'all_cases'        => (new Cases)->count(),
            'unassigned_cases' => (new Cases)->unassignedCases()->count(),
            'assigned_cases'   => (new Cases)->assignedCases()->count()
        ]);
    }

    /**
     * Get case handler report.
     *
     * @param User $handler
     * @return json
     */
    public function getCaseHandlerReport(User $handler)
    {
        return $this->sendResponse(200, "Case handlers report resolved.", "success", [
            'workingon'   => $handler->active_cases_assigned_to()->count(),
        ]);
    }

    /**
     * Get generated report.
     *
     * @param string $start_date
     * @param string $end_date
     * @param int $handler_id
     * @return json
     */
    public function getGeneratedReport($start_date, $end_date, $handler_id = null)
    {
        if (is_null($handler_id)):
            return $this->sendResponse(200, "Case report resolved.", "success", [
                'cases' => (new Cases)->getCaseByDateRange($start_date, $end_date)
            ]);
        else:
            return $this->sendResponse(200, "Case report resolved.", "success", [
                'cases' => (new Cases)->getCaseByDateRangeAndHandler($start_date, $end_date, $handler_id)
            ]);
        endif;
    }

    /**
     * Export generated report to csv.
     *
     * @param string $start_date
     * @param string $end_date
     * @param int $handler_id
     * @return json
     */
    public function exportGeneratedReportCsv($start_date, $end_date, $handler_id = null)
    {
        $cases       = (new Cases)->submittedCases();
        if (is_null($handler_id)):
            $cases   = (new Cases)->getCaseByDateRange($start_date, $end_date);
        else:
            $cases   = (new Cases)->getCaseByDateRangeAndHandler($start_date, $end_date, $handler_id);
        endif;

        $csvExporter = new \Laracsv\Export();

        $csvExporter->beforeEach(function ($case) {
            $case->case_category = \AppHelper::value('case_categories', $case->case_category);
            $case->case_type     = \AppHelper::value('case_types', $case->case_type);
        });

        $csvExporter->build($cases, ['subject', 'parties', 'case_category', 'case_type', 'applicant_firm', 'applicant_fullname', 'applicant_email', 'applicant_phone_number', 'applicant_address', 'submitted_at'])->download('case_report.csv');
    }
}
