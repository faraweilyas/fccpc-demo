<?php

namespace App\Http\Controllers\Api;

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
}

