<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Mail\ApplicationRequest;
use App\Models\Cases;

class ApplicationAuthController extends Controller
{
    /**
     * Send response.
     * @param int $statusCode
     * @param string $message
     * @param string $responseType
     * @param mixed $response
     * @return void
     */
    public static function sendResponse(int $statusCode, string $message, string $responseType, ...$response)
    {
        echo json_encode([
            'statusCode'    => $statusCode,
            'message'       => $message,
            'responseType'  => $responseType,
            'response'      => (count($response) > 1) ? $response : $response[0],
        ]);

        http_response_code($statusCode);
        exit;
    }

    /**
     * Create New Case.
     * @param string $id
     * @return void
     */
    public static function createNewCase(Request $request, $id)
    {
        $subject                = trim($request->subject);
        if(isset($request->party)):
            if (is_array($request->party) && count($request->party) > 0)
                $parties        = implode(',', $request->party);
        endif;

        $case_id                = $request->case_id ?? 0;
        $ref_no                 = $request->ref_no  ?? '';
        $transaction_type       = $request->transaction_type;
        $transaction_category   = $request->transaction_category;
        $representingFirm       = $request->representingFirm;
        $fName                  = trim($request->fName);
        $lName                  = trim($request->lName);
        $email                  = trim($request->email);
        $phone                  = trim($request->phone);
        $address                = trim($request->address);
        $company_doc            = !empty($_FILES['company_doc']['name']) ? $_FILES['company_doc'] : [];
        $newFileName            = substr(uniqid(), 5, 13).".$id";

        $case_arr               = \App\Enhancers\AppHelper::getArray('case_categories');
        $case                   = Cases::where('tracking_id', '=', $id)->first();
        $new_case               = new Cases;
        if (!$case):
            $result = Cases::create([
                'ref_no'                => '',
                'tracking_id'           => $id,
                'subject'               => $subject,
                'parties'               => $parties,
                'transaction_type'      => $transaction_type,
                'transaction_category'  => array_search(strtoupper($transaction_category), $case_arr),
                'applicant_firm'        => $representingFirm,
                'applicant_first_name'  => $fName,
                'applicant_last_name'   => $lName,
                'applicant_email'       => $email,
                'applicant_phone_no'    => $phone,
                'applicant_address'     => $address
            ]);
        else :
            $result = Cases::where('tracking_id', '=', $id)->update([
                'tracking_id'           => $id,
                'subject'               => $subject,
                'parties'               => $parties,
                'transaction_type'      => $transaction_type,
                'transaction_category'  => array_search(strtoupper($transaction_category), $case_arr),
                'applicant_firm'        => $representingFirm,
                'applicant_first_name'  => $fName,
                'applicant_last_name'   => $lName,
                'applicant_email'       => $email,
                'applicant_phone_no'    => $phone,
                'applicant_address'     => $address
            ]);
        endif;

        if ($result):
            static::sendResponse(200, "OK!", "success", $result);
        else:
            static::sendResponse(400, "Bad request", "error", '');
        endif;
    }

    /**
     * Upload New Case.
     * @param string $id
     * @return void
     */
    public static function uploadNewCase(Request $request, $id)
    {
        $result      = Cases::where('tracking_id', '=', $id)->update([
            'ref_no' => generateRefNo($id),
            'status' => 1
        ]);

        if ($result):
            $case = Cases::where('tracking_id', '=', $id)->first();
            Mail::to($case->applicant_email)->send(new ApplicationRequest([
                'firstName'       => $case->applicant_first_name,
                'lastName'        => $case->applicant_last_name,
                'ref_no'          => $case->ref_no
            ]));
            static::sendResponse(200, "OK!", "success", $case);
        else:
            static::sendResponse(400, "Bad request", "error", '');
        endif;
    }
}
