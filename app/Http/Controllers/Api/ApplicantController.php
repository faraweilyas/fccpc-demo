<?php

namespace App\Http\Controllers\Api;

use App\Models\Guest;
use Illuminate\Http\Request;
use App\Mail\WelcomeApplicant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class ApplicantController extends Controller
{
    /**
     * Create New Applicant.
     *
     * @return void
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
	        'email' => 'required|string|email',
	    ]);

        if($validator->fails()):
            return response()->json($validator->errors(), 400);
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