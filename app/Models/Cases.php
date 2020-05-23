<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    protected $fillable = [
		'ref_no', 'tracking_id', 'subject', 'parties', 'case_rep', 'transaction_type', 'transaction_category', 'application_firm', 'applicant_first_name', 'applicant_last_name', 'applicant_email', 'applicant_phone_no', 'applicant_address', 'applicant_company_documents', 'applicant_account_documents', 'applicant_payment_documents', 'status', 'case_handler_id', 'recommendation', 'comments', 'request_id'
	];
}
