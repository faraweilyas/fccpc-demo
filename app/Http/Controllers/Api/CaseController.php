<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Models\User;
use App\Models\Cases;
use App\Models\Document;
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
                'handlers' => User::where('account_type', 'CH')->get(),
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
        $case    = Cases::find(request()->case_id);
        $handler = User::find(request()->handler_id);
        $case->assign($handler);

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
        $case    = Cases::find(request()->case_id);
        $handler = User::find(request()->handler_id);
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
        $case             = Cases::find(request()->case_id);
        $previous_handler = User::find(request()->previous_handler_id);
        $new_handler      = User::find(request()->new_handler_id);
    	$case->reAssign($previous_handler, $new_handler);
    	return $this->sendResponse(200, "Case reassigned.", "success", [
            'case'                   => $case,
            'previous_case_handler'  => $previous_handler,
            'new_handler'            => $new_handler
        ]);
    }

    /**
     * Get case details.
     *
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
     * Get generated report.
     *
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
