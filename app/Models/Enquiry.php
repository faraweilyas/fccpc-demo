<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $guarded = [];

    /**
     * Get user
     *
     * @return HasRelationship
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'handler_id');
    }

    /**
     * Get enquiries
     *
     * @param $user
     * @return array
     */
    public static function getEnquiries($user)
    {
        return ($user->isCaseHandler())
            ? static::where('handler_id', $user->id)->orderBy('id', 'DESC')->get()
            : static::orderBy('id', 'DESC')->get();
    }

    /**
     * Get fullname
     *
     * @return String
     */
    public function getFullName($textStyle='strtoupper') : string
    {
        return textTransformer($this->first_name.' '.$this->last_name, $textStyle);
    }

    /**
     * Get enquiry type
     *
     * @param String $textStyle
     * @return String
     */
    public function getEnquiryType($textStyle='strtolower') : string
    {
        return \AppHelper::value('enquiry_types', $this->type, $textStyle);
    }

    /**
     * Get enquiry type HTML
     *
     * @param String $textStyle
     * @return String
     */
    public function getEnquiryTypeHTML($textStyle='strtolower') : string
    {
        return \AppHelper::value('enquiry_types_html', $this->type, $textStyle);
    }

    /**
     * Get message
     *
     * @param String $textStyle
     * @return String
     */
    public function getMessage($textStyle='strtoupper') : string
    {
        return textTransformer(shortenContent($this->message ?? '...', 30), $textStyle);
    }

    /**
     * Get enquiry type
     *
     * @return String
     */
    public function getStatus() : string
    {
        return !empty($this->status) ? strtoupper($this->status) : '...';
    }

    /**
     * Get handler name
     *
     * @return String
     */
    public function getHandlerName() : string
    {
        return !empty($this->handler_id) ? strtoupper($this->user->getFullName()) : '...';
    }

    /**
     * Get submitted at
     *
     * @param String $format
     * @return String
     */
    public function getSubmittedAt(string $format='customdate') : string
    {
        return !empty($this->created_at) ? datetimeToText($this->created_at, $format) : "";
    }
}
