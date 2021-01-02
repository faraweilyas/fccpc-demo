<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'handler_id');
    }

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

    public function getStatus() : string
    {
        return !empty($this->status) ? strtoupper($this->status) : '...';
    }

    public function getHandlerName() : string
    {
        return !empty($this->handler_id) ? strtoupper($this->user->getFullName()) : '...';
    }

    public function getSubmittedAt(string $format='customdate') : string
    {
        return !empty($this->created_at) ? datetimeToText($this->created_at, $format) : "";
    }
}
