<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Cases;
use App\Models\ChecklistGroup;
use App\Models\Document;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CasesController extends Controller
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
