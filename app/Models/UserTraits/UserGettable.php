<?php

namespace App\Models\UserTraits;

use App\Models\Faq;
use App\Models\Cases;
use App\Models\Enquiry;

trait UserGettable
{
    /**
     * Gets case handlers
     *
     * @return Collection
     */
    public function caseHandlers()
    {
        return static::where('account_type', 'CH')->where('status', 'active')->get();
    }

    /**
     * Gets case supervisors
     *
     * @return Collection
     */
    public function supervisors()
    {
        return static::where('account_type', 'SP')->where('status', 'active')->get();
    }

    /**
     * Defines a one to many relationship for user that has created one or more cases
     * The user is expected to be a registrar
     *
     * @return HasRelationships
     */
    public function cases()
    {
        return $this->hasMany(Cases::class);
    }

    /**
     * Defines a one to many relationship for user that has been assigned enquiries
     * The user is expected to be a case handler
     *
     * @return HasRelationships
     */
    public function enquiries()
    {
        return $this->hasMany(Enquiry::class, 'handler_id');
    }

    /**
     * Defines a many to many relationship for user that has assigned another user
     * to one or more cases and the user is expected to be a supervisor
     *
     * @return HasRelationships
     */
    public function cases_assigned_by()
    {
        return $this->belongsToMany(Cases::class, 'case_handler', 'supervisor_id', 'case_id')
            ->as('case_handler')
            ->withPivot('handler_id', 'defficiency_issued_at', 'dropped_at', 'archived_at')
            ->withTimestamps();
    }

    /**
     * Defines a many to many relationship for case and dropped case handlers
     *
     * @return HasRelationships
     */
    public function dropped_cases_assigned_by()
    {
        return $this->cases_assigned_by()->where('dropped_at', '!=', null);
    }

    /**
     * Defines a many to many relationship for user that has been assigned to one or more cases
     * The user is expected to be a case handler
     *
     * @return HasRelationships
     */
    public function cases_assigned_to()
    {
        return $this->belongsToMany(Cases::class, 'case_handler', 'handler_id', 'case_id')
            ->as('case_handler')
            ->withPivot('supervisor_id', 'defficiency_issued_at', 'dropped_at', 'archived_at')
            ->withTimestamps();
    }

    /**
     * Defines a many to many relationship for case and active case handlers
     *
     * @return HasRelationships
     */
    public function active_cases_assigned($handler = FALSE)
    {
        if ($handler):
            return $this->cases_assigned_to()
                ->where('dropped_at', null)
                ->where('workingon_at', null)
                ->where('defficiency_issued_at', null)
                ->latest();
        endif;
        if (in_array(auth()->user()->account_type, ['SP'])):
            return $this->cases_assigned_by()
                ->where('dropped_at', null)
                ->where('workingon_at', null)
                ->where('defficiency_issued_at', null)
                ->latest();
        else:
            return $this->cases_assigned_to()
                ->where('dropped_at', null)
                ->where('workingon_at', null)
                ->where('defficiency_issued_at', null)
                ->latest();
        endif;
    }

     /**
     * Defines a many to many relationship for active case assigned to handler
     *
     * @return HasRelationships
     */
    public function active_cases_assigned_to_all()
    {
        return $this->cases_assigned_to()->where('dropped_at', null);
    }

    /**
     * Searches for active cases assigned
     *
     * @return HasRelationships
     */
    public function search_active_cases_assigned_to($search)
    {
        return $this->active_cases_assigned_to_all()
            ->where('subject', 'LIKE', '%'.$search.'%')
            ->orWhere('parties', 'LIKE', '%'.$search.'%')
            ->where('handler_id', $this->id)
            ->get();
    }

    /**
     * Searches for users by supervisor
     *
     * @param String $search
     *
     * @return array
     */
    public function search_users($search)
    {
        $users = $this->where('first_name', 'LIKE', '%'.$search.'%')
                ->orWhere('last_name', 'LIKE', '%'.$search.'%')
                ->orWhere('email', 'LIKE', '%'.$search.'%')
                ->get();

        return $users;
    }

    /**
     * Searches for users and faqs by admin
     *
     * @param String $search
     *
     * @return array
     */
    public function search_users_and_faqs($search)
    {
        $users = $this->where('first_name', 'LIKE', '%'.$search.'%')
                ->orWhere('last_name', 'LIKE', '%'.$search.'%')
                ->orWhere('email', 'LIKE', '%'.$search.'%')
                ->get();
        $faqs  = Faq::where('question', 'LIKE', '%'.$search.'%')
                ->get();

        return (object)[
            'users' => $users,
            'faqs'  => $faqs
        ];
    }

    /**
     * Gets all cases
     *
     * @return Collection
     */
    public function all_cases($handler = FALSE)
    {
        if ($handler):
            return $this->cases_assigned_to()
                ->where('dropped_at', null)
                ->latest();
        endif;

        if (in_array(auth()->user()->account_type, ['SP'])):
            return (new Cases)->where('submitted_at', '!=', null);
        else:
            return $this->cases_assigned_to()
                ->where('dropped_at', null)
                ->latest();
        endif;
    }

    /**
     * Gets cases on going
     *
     * @return HasRelationships
     */
    public function cases_working_on($handler = FALSE)
    {
        if ($handler):
            return $this->cases_assigned_to()
                ->where('dropped_at', null)
                ->where('workingon_at', '!=', null)
                ->where('defficiency_issued_at', null)
                ->where('approval_status', null)
                ->latest();
        endif;
        if (in_array(auth()->user()->account_type, ['SP'])):
            return $this->cases_assigned_by()
                ->where('dropped_at', null)
                ->where('workingon_at', '!=', null)
                ->where('defficiency_issued_at', null)
                ->where('approval_status', null)
                ->latest();
        else:
            return $this->cases_assigned_to()
                ->where('dropped_at', null)
                ->where('workingon_at', '!=', null)
                ->where('defficiency_issued_at', null)
                ->where('approval_status', null)
                ->latest();
        endif;
    }

    /**
     * Gets deficient cases
     *
     * @return Collection
     */
    public function deficient_cases($handler = FALSE)
    {
        if ($handler):
            return $this->cases_assigned_to()
                    ->where('dropped_at', null)
                    ->where('workingon_at', '!=', null)
                    ->where('defficiency_issued_at', '!=', null)
                    ->latest();
        endif;
        if (in_array(auth()->user()->account_type, ['SP'])):
            return $this->cases_assigned_by()
                    ->where('dropped_at', null)
                    ->where('workingon_at', '!=', null)
                    ->where('defficiency_issued_at', '!=', null)
                    ->latest();
        else:
            return $this->cases_assigned_to()
                    ->where('dropped_at', null)
                    ->where('workingon_at', '!=', null)
                    ->where('defficiency_issued_at', '!=', null)
                    ->latest();
        endif;
    }

    /**
     * Gets approved cases
     *
     * @return Collection
     */
    public function approved_cases($handler = FALSE)
    {
        if ($handler):
            return $this->cases_assigned_to()
                    ->where('dropped_at', null)
                    ->where('workingon_at', '!=', null)
                    ->where('approval_status', 'approved')
                    ->where('archived_at', null)
                    ->latest();
        endif;
        if (in_array(auth()->user()->account_type, ['SP'])):
            return $this->cases_assigned_by()
                    ->where('dropped_at', null)
                    ->where('workingon_at', '!=', null)
                    ->where('approval_status', 'approved')
                    ->where('archived_at', null)
                    ->latest();
        else:
            return $this->cases_assigned_to()
                    ->where('dropped_at', null)
                    ->where('workingon_at', '!=', null)
                    ->where('approval_status', 'approved')
                    ->where('archived_at', null)
                    ->latest();
        endif;
    }

    /**
     * Gets archived cases
     *
     * @return Collection
     */
    public function archived_cases($handler = FALSE)
    {
        if ($handler):
            return $this->cases_assigned_to()
                    ->where('dropped_at', null)
                    ->where('workingon_at', '!=', null)
                    ->where('approval_status', 'approved')
                    ->where('archived_at', '!=', null)
                    ->latest();
        endif;
        if (in_array(auth()->user()->account_type, ['SP'])):
            return $this->cases_assigned_by()
                    ->where('dropped_at', null)
                    ->where('workingon_at', '!=', null)
                    ->where('approval_status', 'approved')
                    ->where('archived_at', '!=', null)
                    ->latest();
        else:
            return $this->cases_assigned_to()
                    ->where('dropped_at', null)
                    ->where('workingon_at', '!=', null)
                    ->where('approval_status', 'approved')
                    ->where('archived_at', '!=', null)
                    ->latest();
        endif;
    }

    /**
     * Defines a many to many relationship for case and dropped case handlers
     *
     * @return HasRelationships
     */
    public function dropped_cases_assigned_to()
    {
        return $this->cases_assigned_to()->where('dropped_at', '!=', null);
    }
}
