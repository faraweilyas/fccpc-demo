<?php

namespace App\Http\Controllers\Api;

use App\Models\Guest;
use App\Mail\WelcomeApplicant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\ApiResponseTrait;

class ApplicantController extends Controller
{
    use ApiResponseTrait;
    
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
        	'tracking_id' => $guest->tracking_id,
            'email'       => $guest->email
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
	        'tracking_id' => 'required',
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
        		'submitted' => true,
                'guest'     => [
                    'tracking_id'   => $guest->tracking_id,
                    'email'         => $guest->email
                ]
	        ]);

        return (!$guest->case->isCategorySet())
                ?  $this->sendResponse(200, 'success', 'Guest exists!', [
		        		'submitted'     => false,
		        		'category'      => null,
                        'guest'         => [
                            'tracking_id'   => $guest->tracking_id,
                            'email'         => $guest->email
                        ]
			        ])
                :	$this->sendResponse(200, 'success', 'Guest exists!', [
		        		'submitted'     => false,
		        		'category' 		=> $guest->case->case_category,
                        'guest'         => [
                            'tracking_id'   => $guest->tracking_id,
                            'email'         => $guest->email
                        ]
			        ]); 
    }
}