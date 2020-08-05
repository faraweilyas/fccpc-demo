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
     * @return json
     */
    public function getChecklistGroups()
    {
        return $this->sendResponse(200, 'success', 'Checklist groups resolved!', [
        		'checklist_groups' => ChecklistGroup::all(),
	        ]);
	}

	/**
     * Get checklists.
     *
     * @return json
     */
    public function getChecklists()
    {
        return $this->sendResponse(200, 'success', 'Checklists resolved!', [
        		'checklists' => Checklist::all(),
	        ]);
	}

	/**
     * Get case types.
     *
     * @return json
     */
    public function getCaseTypes()
    {
        return $this->sendResponse(200, 'success', 'Types resolved!', [
        		'types' => \AppHelper::get('case_types'),
	        ]);
	}

    /**
     * Get case application.
     *
     * @param Guest $guest
     * @return json
     */
    public function getCaseApplication(Guest $guest)
    {
        $case = $guest->case;

        return $this->sendResponse(200, 'success', 'Case application resolved!', [
                'case'                    => $case,
                'case_category'           => $case->getCategory(),
                'case_parties'            => $case->getCaseParties(false),
                'checklistIds'            => $case->getChecklistIds(),
                'checklistGroupDocuments' => $case->getChecklistGroupDocuments(),
            ]);
    }

    /**
     * Save case category
     *.
     * @param Guest $guest
     * @param string $case_category_key
     * @return json
     */
    public function saveCategory(Guest $guest, string $case_category_key)
    {
        // Validate case category
        if (!\AppHelper::validateKey('case_categories', strtoupper($case_category_key)))
             return $this->sendResponse(404, 'error', 'Category does not exist!');

        $case = $guest->case;

        // Save selected case category
        $case->saveCategory($case_category_key);

        return $this->sendResponse(200, 'success', 'Category saved!');
    }

	/**
     * Save case info.
     *
     * @param Guest $guest
     * @return json
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
     * @return json
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
