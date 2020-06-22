<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
	protected $table = 'cases';

    protected $fillable = [
		'user_id', 'guest_id', 'reference_number', 'subject', 'parties', 'case_category', 'case_type',
        'applicant_firm', 'applicant_first_name', 'applicant_last_name', 'applicant_email', 'applicant_phone_no', 'applicant_address'
	];

    public function getRefNO($textStyle='strtoupper') : string
    {
        $refrenceNo = !empty($this->reference_number) ? "#{$this->reference_number}" : '';
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

    public function getCaseStatus($textStyle='strtolower') : string
    {
        return \AppHelper::value('case_status', $this->status, $textStyle);
    }

    public function getCaseStatusHTML($textStyle='strtolower') : string
    {
        return \AppHelper::value('case_status_html', $this->status, $textStyle);
    }

    public function getCaseHandlerName() : string
    {
        return ($caseHandler = User::find($this->case_handler_id)) ? $caseHandler->getFullName() : "";
    }

    public function getCaseCategory($textStyle='strtolower') : string
    {
        return \AppHelper::value('case_categories', $this->case_category, $textStyle);
    }

    public function getTransactionType($textStyle='ucfirst') : string
    {
        return textTransformer($this->transaction_type ?? '', $textStyle);
    }
}
