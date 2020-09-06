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
}
