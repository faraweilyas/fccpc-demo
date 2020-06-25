<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $guarded = [];

    public function case()
    {
        return $this->belongsTo(Cases::class, 'id', 'guest_id');
    }

    public function startCase()
    {
        return Cases::create([
            'user_id'   => null,
            'guest_id'  => $this->id,
        ]);
    }

    public function getGuestTrackingIdAttribute()
    {
        return strtolower($this->tracking_id);
    }

    public function applicantPath()
    {
        return route('applicant.show');
    }

    public function applicationPath()
    {
        return route('application.index', ['guest' => $this->guest_tracking_id]);
    }

    public function createApplicationPath(string $case_category='reg')
    {
        return route('application.show', ['guest' => $this->guest_tracking_id, 'case_category' => $case_category]);
    }

    public function submittedApplicationPath()
    {
        return route('application.submitted', ['guest' => $this->guest_tracking_id]);
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
