<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Cases;
use App\Models\Guest;
use App\Models\Document;
use App\Models\Checklist;
use App\Models\ChecklistGroup;
use App\Mail\ApplicationRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Api\ApiResponseTrait;

class ApplicationController extends Controller
{
    use ApiResponseTrait;

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
     * Get checklists by group.
     *
     * @param int $group_id
     * @return json
     */
    public function getChecklistsByGroup($group_id)
    {
        return $this->sendResponse(200, 'success', 'Checklists resolved!', [
                'checklists' => Checklist::where('group_id', $group_id)->get(),
            ]);
    }

    /**
     * Handles download checklist group document.
     *
     * @param Document $document
     * @return json
     */
    public function downloadChecklistGroupDocument(Document $document)
    {
        $groupName = \Str::slug($document->checklists[0]->group->name);
        $extension = pathinfo($document->file)['extension'];
        return response()->download(storage_path("app/public/documents/{$document->file}"), "{$groupName}.{$extension}");
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
     * Get calculated fee.
     *
     * @return json
     */
    public function getCalculatedFee()
    {
        $amount            = (int) request('combined_turnover');
        $transaction_type  = request('transaction_type');
        $fillingFee        = 0;
        $processingFee     = 0;
        $expeditedFee      = 0;
        $totalAmount       = 0;
        $result            = 50000;

        if ($amount <= 0):
            $fillingFee        = 0.9;
            $processingFee     = 0;
            $expeditedFee      = 0;
            $totalAmount       = 0;
        endif;

        if ($transaction_type == "REG"):
            if ($amount >= 500000000 && $amount <= 1000000000)
            {
                $result += (0.3 / 100) * 500000000;
                $secondAmount = $amount - 500000000;
                $result += (0.225 / 100) * $secondAmount;
            }
            if ($amount > 1000000000)
            {
                $result += (0.3 / 100) * 500000000;
                $result += (0.225 / 100) * 500000000;
                $thirdAmount = $amount - 1000000000;
                $result += (0.15 / 100) * $thirdAmount;
            }

            $fillingFee        = 50000;
            $processingFee     = $result - 50000;
            $expeditedFee      = 0;
            $totalAmount       = $result;
        elseif ($transaction_type == "FFM"):
            if ($amount >= 500000000 && $amount < 1000000000)
            {
                $result += 2000000;
            }
            if ($amount >= 1000000000)
            {
                $otherAmount = (0.1 / 100) * $amount;
                $result += ($otherAmount > 3000000) ? $otherAmount : 3000000;
            }

            $fillingFee        = 50000;
            $processingFee     = $result - 50000;
            $expeditedFee      = 0;
            $totalAmount       = $result;
        elseif ($transaction_type == "FFX"):
            if ($amount >= 500000000 && $amount < 1000000000)
            {
                $result += 2000000;
            }
            if ($amount >= 1000000000)
            {
                $otherAmount = (0.1 / 100) * $amount;
                $result += ($otherAmount > 3000000) ? $otherAmount : 3000000;
            }

            $fillingFee        = 50000;
            $processingFee     = $result - 50000;
            $expeditedFee      = 5000000;
            $totalAmount       = $result + 5000000;
        endif;

        return $this->sendResponse(200, 'success', 'Combined turnover resolved!', [
            'Filling Fee'    => $fillingFee,
            'Processing Fee' => $processingFee,
            'Expedited Fee'  => $expeditedFee,
            'Total'          => $totalAmount
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
     * Get guest.
     *
     * @param Guest $guest
     * @return json
     */
    public function getGuest(Guest $guest)
    {
        return $this->sendResponse(200, 'success', 'Guest resolved!', [
                'guest' => $guest,
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
            'applicant_fullname'        => request('applicant_fullname'),
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
        $arrayOfChecklistIds    = transformChecklistIds($checklistIds, ["selected_at" => now()]);
        $document->checklists()->syncWithoutDetaching($arrayOfChecklistIds);
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
        $case = $guest->case;

        if (is_null($case->subject) || is_null($case->parties) || is_null($case->case_category) || is_null($case->case_type) || is_null($case->applicant_firm) || is_null($case->applicant_fullname) || is_null($case->applicant_email) || is_null($case->applicant_phone_number) || is_null($case->applicant_address)):
             return $this->sendResponse(400, 'error', 'Provide required fields.');
        endif;

        $guest->case->submit();

        $case = $guest->case;
        try
        {
            Mail::to($guest->email)->send(new ApplicationRequest([
                'fullname'        => $case->applicant_fullname,
                'ref_no'          => $case->ref_no,
                'case'            => $case,
                'guest'           => $guest
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
}
