<?php

namespace App\Models;

trait CaseAssignable
{
    /**
     * A supervisor assigns a new case handler to a case
     *
     * @param  User $caseHandler
     * @param  User|null $supervisor
     * @return array
     */
    public function assign(User $caseHandler, User $supervisor = null)
    {
        $supervisor_id = !is_null($supervisor) ? $supervisor->id : auth()->id();

        return $this->handlers()->syncWithoutDetaching([
            $caseHandler->id    => [
                'supervisor_id' => $supervisor_id
            ]
        ]);
    }

    /**
     * Sets the dropped at timestamp to indicate that a case handler has been dropped
     * from the case but the history of the case with the case handler can be viewed
     * after that it assigns a new case handler to case to continue where it was left off
     *
     * @param  User $currentCaseHandler
     * @param  User $newCaseHandler
     * @param  User|null $supervisor
     * @return array
     */
    public function reAssign(User $currentCaseHandler, User $newCaseHandler, User $supervisor = null)
    {
        $supervisor_id = !is_null($supervisor) ? $supervisor->id : auth()->id();

        return $this->handlers()->syncWithoutDetaching([
            $currentCaseHandler->id => [
                'supervisor_id'     => $supervisor_id,
                'dropped_at'        => now()
            ],
            $newCaseHandler->id     => [
                'supervisor_id'     => $supervisor_id
            ],
        ]);
    }

    /**
     * Sets the dropped at timestamp to indicate that a case handler has been dropped
     * from the case but the history of the case with the case handler can be viewed
     *
     * @param  User $caseHandler
     * @param  User|null $supervisor
     * @return array
     */
    public function retract(User $caseHandler, User $supervisor = null)
    {
        $supervisor_id = !is_null($supervisor) ? $supervisor->id : auth()->id();

        return $this->handlers()->syncWithoutDetaching([
            $caseHandler->id    => [
                'supervisor_id' => $supervisor_id,
                'dropped_at'    => now()
            ]
        ]);
    }

    /**
     * Removes case handler and supervisors relationship from case
     * Which deletes the entire relationship from the database
     *
     * @param  User $caseHandler
     * @return int
     */
    public function disolve(User $caseHandler)
    {
        return $this->handlers()->detach($caseHandler);
    }

    /**
     * Defines a many to many relationship for case and case handlers
     *
     * @return HasRelationships
     */
    public function handlers()
    {
        return $this->belongsToMany(User::class, 'case_handler', 'case_id', 'handler_id')
            ->as('case_handler')
            ->withPivot('supervisor_id', 'dropped_at', 'archived_at')
            ->withTimestamps();
    }

    /**
     * Defines a many to many relationship for case and active case handlers
     *
     * @return HasRelationships
     */
    public function active_handlers()
    {
        return $this->handlers()->where('dropped_at', null);
    }

    /**
     * Defines a many to many relationship for case and dropped case handlers
     *
     * @return HasRelationships
     */
    public function dropped_handlers()
    {
        return $this->handlers()->where('dropped_at', '!=', null);
    }

    /**
     * Defines a many to many relationship for case and supervisors
     *
     * @return HasRelationships
     */
    public function supervisors()
    {
        return $this->belongsToMany(User::class, 'case_handler', 'case_id', 'supervisor_id')
            ->as('case_supervisor')
            ->withPivot('handler_id', 'dropped_at', 'archived_at')
            ->withTimestamps();
    }
}
