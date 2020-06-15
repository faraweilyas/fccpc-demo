<?php

namespace App\Models;

use App\User;
use App\Enhancers\AppHelper;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $table = 'enquiry';

    protected $fillable = [
        'tracking_id', 'caseHandler', 'firm', 'firstName', 'lastName', 'email', 'phone', 'type', 'message', 'file', 'status'
    ];

    /**
     * Get full name
     *
     * @param string $textStyle
     * @return string
     */
    public function getFullName($textStyle='strtoupper') : string
    {
        return textTransformer($this->firstName.' '.$this->lastName, $textStyle);
    }

    public function getEnquiryType($textStyle='strtolower') : string
    {
        return textTransformer(AppHelper::$enquiry_types[$this->type] ?? "", $textStyle);
    }

    public function getEnquiryTypeHTML($textStyle='strtolower') : string
    {
        return textTransformer(AppHelper::$enquiry_typesHTML[$this->type] ?? "", $textStyle);
    }

    /**
     * Get full name
     *
     * @param string $textStyle
     * @return string
     */
    public function getCaseHandler($textStyle='strtoupper') : string
    {
        if ($this->caseHandler != null) {
            $result = User::whereId($this->caseHandler);
            return textTransformer($result->getFullName(), $textStyle);
        }
        return textTransformer('unassigned', $textStyle);
    }
}
