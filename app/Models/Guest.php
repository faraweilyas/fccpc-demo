<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $guarded = [];

    /**
     * Get case
     *
     * @return HasRelationship
     */
    public function case()
    {
        return $this->belongsTo(Cases::class, 'id', 'guest_id');
    }

    /**
     * Start case initializer
     *
     * @return Object
     */
    public function startCase()
    {
        return Cases::create([
            'user_id'   => null,
            'guest_id'  => $this->id,
        ]);
    }

    /**
     * Get guest tracking/application ID
     *
     * @return String
     */
    public function getGuestTrackingIdAttribute()
    {
        return strtolower($this->tracking_id);
    }

    /**
     * Get applicant path
     *
     * @return String
     */
    public function applicantPath()
    {
        return route('applicant.show');
    }

    /**
     * Get application path
     *
     * @return String
     */
    public function applicationPath()
    {
        return route('application.index', ['guest' => $this->guest_tracking_id]);
    }

    /**
     * Get create applciation path
     *
     * @param String $case_category
     * @return String
     */
    public function createApplicationPath(string $case_category)
    {
        return route('application.show', ['guest' => $this->guest_tracking_id, 'case_category' => $case_category]);
    }

    /**
     * Get submitted application path
     *
     * @return String
     */
    public function submittedApplicationPath()
    {
        return route('application.submitted', ['guest' => $this->guest_tracking_id]);
    }

    /**
     * Get upload documents path
     *
     * @return String
     */
    public function uploadDocumentsPath()
    {
        return route('application.upload', ['guest' => $this->guest_tracking_id]);
    }

    /**
     * Get initials from email
     *
     * @param string $textStyle
     * @return string
     */
    public function getInitials($textStyle='strtoupper') : string
    {
        return textTransformer(substr($this->email, 0, 2), $textStyle);
    }

    /**
     * Get formatted tracking id
     *
     * @param string $textStyle
     * @return string
     */
    public function getTrackingID($textStyle='strtoupper') : string
    {
        return textTransformer("#".$this->tracking_id, $textStyle);
    }
}
