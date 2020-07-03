<?php

namespace App\Models\UserTraits;

use App\Models\User;
use App\Models\Cases;

trait UserGettable
{
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
     * Defines a many to many relationship for user that has assigned another user
     * to one or more cases and the user is expected to be a supervisor
     *
     * @return HasRelationships
     */
    public function cases_assigned_by()
    {
        return $this->belongsToMany(Cases::class, 'case_handler', 'supervisor_id', 'case_id')
            ->as('case_handler')
            ->withPivot('handler_id', 'dropped_at', 'archived_at')
            ->withTimestamps();
    }

    /**
     * Defines a many to many relationship for case and active case handlers
     *
     * @return HasRelationships
     */
    public function active_cases_assigned_by()
    {
        return $this->cases_assigned_by()->where('dropped_at', null);
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
            ->withPivot('supervisor_id', 'dropped_at', 'archived_at')
            ->withTimestamps();
    }

    /**
     * Defines a many to many relationship for case and active case handlers
     *
     * @return HasRelationships
     */
    public function active_cases_assigned_to()
    {
        return $this->cases_assigned_to()->where('dropped_at', null);
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