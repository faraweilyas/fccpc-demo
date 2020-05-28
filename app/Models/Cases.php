<?php

namespace App\Models;

use App\Enhancers\AppHelper;
use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
	protected $table = 'cases';

    protected $fillable = [
		'ref_no', 'tracking_id', 'subject', 'parties', 'case_rep', 'transaction_type', 'transaction_category', 'application_firm', 'applicant_first_name', 'applicant_last_name', 'applicant_email', 'applicant_phone_no', 'applicant_address', 'applicant_company_documents', 'applicant_account_documents', 'applicant_payment_documents', 'status', 'case_handler_id', 'recommendation', 'comments', 'request_id'
	];

    public function getCaseCategory($textStyle='strtolower') : string
    {
        $caseCategory = AppHelper::$case_categories[$this->transaction_category];
        return (is_callable($textStyle)) ? $textStyle($caseCategory) : $caseCategory;
    }
}
