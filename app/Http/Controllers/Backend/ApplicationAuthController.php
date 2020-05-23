<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Models\Cases;

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
    public static function createNewCase($id)
    {
        $subject                = trim($_POST['subject']);
        if(isset($_POST['party'])):
            if (is_array($_POST['party']) && count($_POST['party']) > 0)
                $parties        = implode(',', $_POST['party']);
        endif;

        $case_id                = $_POST['case_id'] ?? 0;
        $ref_no                 = $_POST['ref_no']  ?? '';
        $transaction_type       = $_POST['transaction_type'];
        $transaction_category   = $_POST['transaction_category'];
        $representingFirm       = $_POST['representingFirm'];
        $fName                  = trim($_POST['fName']);
        $lName                  = trim($_POST['lName']);
        $email                  = trim($_POST['email']);
        $phone                  = trim($_POST['phone']);
        $address                = trim($_POST['address']);
        $company_doc            = !empty($_FILES['company_doc']['name']) ? $_FILES['company_doc'] : [];
        $newFileName            = substr(uniqid(), 5, 13).".$id";

        if (!empty($company_doc)):
            $fileUpload     = new FileImage($company_doc, $newFileName);
            $fileUpload->setUploadFileDir("documents/cases");
            $fileError      = ($fileUpload->processFile())  ? '' : $fileUpload->error;
            $newCompanyDocName  = $fileUpload->newFileName      ?? '';

            if (!empty($fileError)):
                deleteFile(UPLOAD_COM.$newLogoName);
            endif;

        endif;

        $case_arr               = \App\Enhancers\AppHelper::getArray('case_categories');
        $case                   = Cases::where('tracking_id', '=', $id )->first();
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
            $result = Cases::whereId($case_id->update([
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
            ]));
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
    public static function uploadNewCase($id)
    {
        $case   = Cases::where('tracking_id', '=', $id);
        $result = Cases::where($case_id->update([
            'ref_no' => generateRefNo($id),
            'status' => 1
        ]));
        
        if ($result):
            static::sendResponse(200, "OK!", "success", $result);
        else:
            static::sendResponse(400, "Bad request", "error", '');
        endif;
    }
}