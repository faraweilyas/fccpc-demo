<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $guarded = [];

    public function getFullName($textStyle='strtoupper') : string
    {
        return textTransformer($this->first_name.' '.$this->last_name, $textStyle);
    }

    public function getEnquiryType($textStyle='strtolower') : string
    {
        return \AppHelper::value('enquiry_types', $this->type, $textStyle);
    }

    public function getEnquiryTypeHTML($textStyle='strtolower') : string
    {
        return \AppHelper::value('enquiry_types_html', $this->type, $textStyle);
    }

    public function getMessage($textStyle='strtoupper') : string
    {
        return textTransformer(shortenContent($this->message ?? '...', 30), $textStyle);
    }

    public function getCaseHandler($textStyle='strtoupper') : string
    {
        return textTransformer('unassigned', $textStyle);

        if ($this->caseHandler != null) {
            $result = User::where('id', $this->caseHandler)->first();
            return textTransformer($result->getFullName(), $textStyle);
        }

        return textTransformer('unassigned', $textStyle);
    }
}
