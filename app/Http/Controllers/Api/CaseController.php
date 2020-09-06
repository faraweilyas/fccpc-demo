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
        return $this->sendResponse(200, 'success', 'All assigned cases resolved!', [
        		'cases' => (new Cases)->assignedCases(),
	        ]);
	}

	/**
     * Get case handler assigned cases.
     *
     * @return json
     */
    public function getCaseHandlerAssignedCases(User $handler)
    {
    	if(isset($handler->status)):
            $cases       = $handler->active_cases_assigned_to()->get();
        else:
        	$user 		 = JWTAuth::parseToken()->authenticate();
        	$cases       = $user->active_cases_assigned_to()->get();
        endif;

        return $this->sendResponse(200, 'success', 'Case handler\'s assigned cases resolved!', [
        		'cases' => $cases,
	        ]);
	}

	/**
     * Assign case.
     *
     * @return json
     */
    public function assignCase(Cases $case, User $handler)
    {
    	$case->assign($handler);
    	return $this->sendResponse(200, "Case assigned.", "success");
    }

    /**
     * Unassign case.
     *
     * @return json
     */
    public function unassignCase(Cases $case, User $handler)
    {
    	$case->disolve($handler);
    	return $this->sendResponse(200, "Case unassigned.", "success");
    }

    /**
     * Re-assign case.
     *
     * @return json
     */
    public function reAssignCase(Cases $case, User $previous_handler, User $new_handler)
    {
    	$case->reAssign($previous_handler, $new_handler);
    	return $this->sendResponse(200, "Case reassigned.", "success");
    }
}
