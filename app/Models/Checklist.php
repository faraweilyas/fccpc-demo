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
        if ($this->input_field == 'combined_turnover' && !is_null($case->combined_turnover))
            return $case->combined_turnover;

        if ($this->input_field == 'filling_fee' && !is_null($case->filling_fee))
            return $case->filling_fee;

        return NULL;
    }

    public function getInputPlaceHolder()
    {
        return str_replace('_', ' ', ucwords($this->input_field, '_')).' Amount:';
    }
}
