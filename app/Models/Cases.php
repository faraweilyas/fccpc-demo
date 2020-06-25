<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
	protected $table = 'cases';

    protected $guarded = [];

    public function saveCategory(string $case_category) : bool
    {
        $this->case_category = strtoupper($case_category);
        return $this->save();
    }

    public function creator()
    {
        if (!empty($this->user_id))
            return $this->user();

        if (!empty($this->guest_id))
            return $this->guest();

        return false;
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'case_id');
    }

    public function isSubmitted() : bool
    {
        return is_null($this->submitted_at) ? false : true;
    }

    public function selectedCategoryStyle($case_category='reg') : \stdClass
    {
        $case_category = strtoupper($case_category);
        return (object) [
            'bg'        => ($this->case_category == $case_category) ? 'bg-success' : '',
            'svg'       => ($this->case_category == $case_category) ? 'svg-icon-white' : 'svg-icon-primary',
            'text'      => ($this->case_category == $case_category) ? 'text-inverse-success' : 'text-dark',
            'textsm'    => ($this->case_category == $case_category) ? 'text-inverse-success' : 'text-muted text-hover-primary',
        ];
    }

    public function getRefNO($textStyle='strtoupper') : string
    {
        $refrenceNo = !empty($this->reference_number) ? "#{$this->reference_number}" : '';
        return textTransformer($refrenceNo, $textStyle);
    }

    public function getCaseParties(bool $collect=true)
    {
        $parties = (empty($this->parties)) ? [] : explode(':', $this->parties);
        return ($collect) ? collect($parties) : $parties;
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

    public function getCaseCategory($textStyle='strtoupper') : string
    {
        return \AppHelper::value('case_categories', $this->case_category, $textStyle);
    }

    public function getTransactionType($textStyle='ucfirst') : string
    {
        return textTransformer($this->transaction_type ?? '', $textStyle);
    }
}
