<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $guarded = [];

    public function group()
    {
        return $this->belongsTo(ChecklistGroup::class, 'group_id');
    }

    public function hasInputField() : bool
    {
        return !empty($this->input_field) ? TRUE : FALSE;
    }

    public function isInputFieldFillingFee() : bool
    {
        return ($this->input_field == 'filling_fee') ? TRUE : FALSE;
    }

    /**
     * Checks if case category is FFM Expedited to show expedited fee option
     *
     * @param Cases $case
     * @return bool
     */
    public function isCaseCategoryFFX(Cases $case) : bool
    {
        if ($this->hasInputField() && $this->input_field == 'expedited_fee')
        {

            return ($case->case_category == "FFX") ? TRUE : FALSE;
        }

        return TRUE;
    }

    /**
     * Get input
     *
     * @param mixed $textStyle
     * @return string
     */
    public function getInput($textStyle='strtolower')
    {
        return textTransformer($this->input_field, $textStyle);
    }

    /**
     * Get value
     *
     * @param Cases $case
     * @return string
     */
    public function getValue(Cases $case)
    {
        if ($this->input_field == 'combined_turnover' && !empty($case->combined_turnover))
            return $case->combined_turnover;

        if ($this->isInputFieldFillingFee())
            return 50000;

        return '';
    }

    public function getInputPlaceHolder()
    {
        return str_replace('_', ' ', ucwords($this->input_field, '_')).' Amount:';
    }
}
