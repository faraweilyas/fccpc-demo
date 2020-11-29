<?php

namespace App\Models\CaseTraits;

use App\Models\User;

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
     * A case handler issues deficiency
     *
     * @param  User $caseHandler
     * @return array
     */
    public function issueDeficiency(User $caseHandler)
    {
        return $this->handlers()->syncWithoutDetaching([
            $caseHandler->id    => [
                'defficiency_issued_at' => now()
            ]
        ]);
    }

    /**
     * A case handler approves checklists
     *
     * @param  User $caseHandler
     * @return array
     */
    public function approveChecklists(User $caseHandler)
    {
        return $this->handlers()->syncWithoutDetaching([
            $caseHandler->id    => [
                'checklist_approval_issued_at' => now()
            ]
        ]);
    }

    /**
     * A case handler issues recommendation
     *
     * @param  User $caseHandler
     * @return array
     */
    public function issueReccomendation(User $caseHandler, $file_name, $recommendation)
    {
        return $this->handlers()->syncWithoutDetaching([
            $caseHandler->id    => [
                'analysis_document'        => $file_name,
                'recommendation_issued_at' => now(),
                'recommendation'           => $recommendation
            ]
        ]);
    }

    /**
     * An applicant removes deficiency
     *
     * @param  User $caseHandler
     * @return array
     */
    public function removeDeficiency(User $caseHandler)
    {
        return $this->handlers()->syncWithoutDetaching([
            $caseHandler->id    => [
                'defficiency_issued_at' => null
            ]
        ]);
    }

    /**
     * A case handler updates working on
     *
     * @param  User $caseHandler
     * @return array
     */
    public function update_working_on(User $caseHandler)
    {
        if (auth()->user()->account_type == 'SP'):
            $data = [
                $caseHandler->id     => [
                    'workingon_at'   => now(),
                    'supervisor_id'  => auth()->user()->id,
                ]
            ];
        else:
            $data = [
                $caseHandler->id     => [
                    'workingon_at'   => now(),
                ]
            ];
        endif;

        return $this->handlers()->syncWithoutDetaching($data);
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
            ->withPivot('supervisor_id', 'defficiency_issued_at', 'checklist_approval_issued_at', 'analysis_document', 'recommendation', 'recommendation_issued_at', 'dropped_at', 'archived_at')
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
}
