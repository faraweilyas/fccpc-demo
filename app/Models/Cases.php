<?php

namespace App\Models;

use App\User;
use App\Enhancers\AppHelper;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
	protected $table = 'cases';

    protected $fillable = [
		'ref_no', 'tracking_id', 'subject', 'parties', 'transaction_type', 'transaction_category', 'application_firm', 'applicant_first_name',
        'applicant_last_name', 'applicant_email', 'applicant_phone_no', 'applicant_address', 'applicant_company_documents',
        'applicant_account_documents', 'applicant_payment_documents', 'status', 'case_handler_id', 'recommendation', 'comments', 'request_id'
	];

    public function getRefNO($textStyle='strtoupper') : string
    {
        $refrenceNo = !empty($this->ref_no) ? "#{$this->ref_no}" : '';
        return textTransformer($refrenceNo, $textStyle);
    }

    public function getCaseParties() : Collection
    {
        $parties = ($this->parties == "," || empty($this->parties)) ? [] : explode(',', $this->parties);
        return collect($parties);
    }

    public function generateCasePartiesBadge() : string
    {
        $styles = ['success', 'danger', 'warning', 'info', 'primary'];
        return $this->getCaseParties()->map(function($party) use ($styles)
        {
            $style = $styles[rand(0, count($styles) - 1)];
            return "<span class='label label-lg font-weight-bold label-light-{$style} text-dark label-inline mr_10'>{$party}</span>";
        })->join(" ");
    }

    public function getCaseCategory($textStyle='strtolower') : string
    {
        return textTransformer(AppHelper::$case_categories[$this->transaction_category] ?? "", $textStyle);
    }

    public function getCaseStatus($textStyle='strtolower') : string
    {
        return textTransformer(AppHelper::$case_status[$this->status] ?? "", $textStyle);
    }

    public function getCaseStatusHTML($textStyle='strtolower') : string
    {
        return textTransformer(AppHelper::$case_statusHTML[$this->status] ?? "", $textStyle);
    }

    public function getCaseHandlerName() : string
    {
        return ($caseHandler = User::find($this->case_handler_id)) ? $caseHandler->getFullName() : "";
    }

    public function getTransactionType($textStyle='ucfirst') : string
    {
        return textTransformer($this->transaction_type ?? '', $textStyle);
    }
}
