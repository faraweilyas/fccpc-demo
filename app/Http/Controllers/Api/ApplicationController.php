<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Cases;
use App\Models\Guest;
use App\Models\ChecklistGroup;
use App\Models\Checklist;
use App\Models\Document;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ApplicationController extends Controller
{
	/**
     * Get checklist groups.
     *
     * @return void
     */
    public function getChecklistGroups()
    {
        return $this->sendResponse(200, 'success', 'Checklist Groups Resolved!', [
        		'checklist_groups' => ChecklistGroup::all(),
	        ]);
	}

	/**
     * Get checklists.
     *
     * @return void
     */
    public function getChecklists()
    {
        return $this->sendResponse(200, 'success', 'Checklists Resolved!', [
        		'checklists' => Checklist::all(),
	        ]);
	}

	/**
     * Get case types.
     *
     * @return void
     */
    public function getCaseTypes()
    {
        return $this->sendResponse(200, 'success', 'Types Resolved!', [
        		'types' => \AppHelper::get('case_types'),
	        ]);
	}

	/**
     * Save case info.
     *
     * @return void
     */
	public function saveCaseInfo(Guest $guest)
    {
        $parties = is_array(request('parties')) ? request('parties') : [];

        $guest->case->saveCaseInfo(
            request('subject'),
            implode(':', $parties),
            request('case_type')
        );

        return $this->sendResponse(200, 'success', 'Case info saved.', [
        		'case' => $guest->case,
	        ]);
    }

	/**
     * Send response.
     * @param int $statusCode
     * @param string $message
     * @param string $responseType
     * @param mixed $response
     * @return void
     */
    public function sendResponse(int $statusCode, string $message, string $responseType, $response=null)
    {
        return response()->json([
        	'statusCode' 	=> $statusCode,
            'message'       => $message,
            'responseType'  => $responseType,
            'response'      => $response,
        ]);
    }
}
