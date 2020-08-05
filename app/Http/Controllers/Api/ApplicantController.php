<?php

namespace App\Http\Controllers\Api;

use App\Models\Guest;
use App\Mail\WelcomeApplicant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class ApplicantController extends Controller
{
    /**
     * Create New Applicant.
     *
     * @return json
     */
    public function store()
    {
        $validator = Validator::make(request()->all(), [
	        'email' => 'required|string|email',
	    ]);

        if($validator->fails()):
        	return $this->sendResponse(400, 'error', 'Field validation error!', [
	        	$validator->errors()
	        ]);
        endif;

        $guest = Guest::create([
            'ip_address'    => request()->ip(),
            'email'         => trim(request('email')),
            'tracking_id'   => \SerialNumber::trackingId(),
        ]);

        $case = $guest->startCase();

        try
        {
            Mail::to(request('email'))->send(new WelcomeApplicant($guest, $case));
        }
        catch (\Exception $exception)
        {
            $message = $exception->getMessage();
        }

        return $this->sendResponse(201, 'success', 'Guest created!', [
        	'tracking_id' => $guest->tracking_id
        ]);
    }

    /**
     * Handles the tracking authentication.
     *
     * @return json
     */
    public function authenticateTracking()
    {
        $validator = Validator::make(request()->all(), [
	        'tracking_id' => ['required', 'exists:guests,tracking_id'],
	    ]);

	    if($validator->fails()):
           	return $this->sendResponse(400, 'error', 'Field validation error!', [
	        	$validator->errors()
	        ]);
        endif;

        $guest = Guest::where('tracking_id', '=', request('tracking_id'))->firstOrFail();

        // Check if case has been submitted
        if ($guest->case->isSubmitted())
        	return $this->sendResponse(200, 'success', 'Guest exists!', [
        		'submitted' => true
	        ]);

        return (!$guest->case->isCategorySet())
                ?  $this->sendResponse(200, 'success', 'Guest exists!', [
		        		'submitted'     => false,
		        		'category'      => null
			        ])
                :	$this->sendResponse(200, 'success', 'Guest exists!', [
		        		'submitted'     => false,
		        		'category' 		=> $guest->case->case_category,
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