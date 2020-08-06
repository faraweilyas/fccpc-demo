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
     * Get case categories.
     *
     * @return json
     */
    public function getCaseCategories()
    {
        return $this->sendResponse(200, 'success', 'Categories resolved!', [
                'categories' => \AppHelper::get('case_categories'),
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

        return $this->sendResponse(201, 'success', 'Category saved!');
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

        return $this->sendResponse(201, 'success', 'Case info saved.', [
        		'case' => $guest->case,
	        ]);
    }

    /**
     * Save contact info.
     *
     * @param Guest $guest
     * @return json
     */
    public function saveContactInfo(Guest $guest)
    {
        $guest->case->saveContactInfo((object) [
            'applicant_firm'            => request('applicant_firm'),
            'applicant_first_name'      => request('applicant_first_name'),
            'applicant_last_name'       => request('applicant_last_name'),
            'applicant_email'           => request('applicant_email'),
            'applicant_phone_number'    => request('applicant_phone_number'),
            'applicant_address'         => request('applicant_address'),
        ]);

        return $this->sendResponse(201, 'success', 'Contact info saved.', [
                'case' => $guest->case,
            ]);
    }

    /**
     * Save checklist document.
     *
     * @param Guest $guest
     * @return json
     */
    public function saveChecklistDocument(Guest $guest)
    {
        if (!request()->hasFile('file'))
            return $this->sendResponse(400, 'error', 'No file has been uploaded.', []);

        $file           = request('file');
        $extension      = $file->getClientOriginalExtension();
        $newFileName    = \SerialNumber::randomFileName($extension);
        $path           = $file->storeAs('public/documents', $newFileName);

        if (request('override')):
            $previous_document = Document::find(request('document_id'));
            unlink(storage_path('app/public/documents/'.$previous_document->file));
            Document::destroy($previous_document->id);
        endif;

        $document               = Document::create([
            'case_id'           => $guest->case->id,
            'file'              => $newFileName,
            'additional_info'   => trim(request('additional_info')),
        ]);

        $checklistIds           = request('checklists');
        $arrayOfChecklistIds    = (array) explode(',', $checklistIds);
        $document->checklists()->syncWithoutDetaching($arrayOfchecklistIds);
        return $this->sendResponse(201, 'success', 'Document has been saved.', [
                'document' => $document,
            ]);
    }

    /**
     * Submit case.
     *
     * @param Guest $guest
     * @return void
     */
    public function submit(Guest $guest)
    {
        $guest->case->submit();

        $case = $guest->case;
        try
        {
            Mail::to($case->applicant_email)->send(new ApplicationRequest([
                'firstName'       => $case->applicant_first_name,
                'lastName'        => $case->applicant_last_name,
                'ref_no'          => $case->ref_no
            ]));
        }
        catch (\Exception $exception)
        {
            $message = $exception->getMessage();
        }

        return $this->sendResponse(200, 'success', 'Application submitted.', [
                'case' => $case,
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
