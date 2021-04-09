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
     * A supervisor/handler archives an approved case
     *
     * @param  User $caseHandler
     * @return array
     */
    public function archive(User $caseHandler)
    {
        return $this->handlers()->syncWithoutDetaching([
            $caseHandler->id    => [
                'archived_at' => now()
            ]
        ]);
    }

    /**
     * A supervisor/handler updates approval letter sent at timestamp
     *
     * @param  User $caseHandler
     * @return array
     */
    public function approvalLetterSent(User $caseHandler)
    {
        return $this->handlers()->syncWithoutDetaching([
            $caseHandler->id    => [
                'approval_letter_sent_at' => now()
            ]
        ]);
    }

    /**
     * A case handler issues deficiency
     *
     * @param  User $caseHandler
     * @param  String $defficiency
     * @return array
     */
    public function issueDeficiency(User $caseHandler, $defficiency)
    {
        return $this->handlers()->syncWithoutDetaching([
            $caseHandler->id    => [
                'defficiency_issued_at' => now(),
                'defficiency'           => $defficiency
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
     * A case handler send approval request to supervisor
     *
     * @param  User $caseHandler
     * @return array
     */
    public function issueApprovalRequest(User $caseHandler)
    {
        return $this->handlers()->syncWithoutDetaching([
            $caseHandler->id    => [
                'approval_requested_at' => now()
            ]
        ]);
    }

     /**
     * A supervisor issues approval comment
     *
     * @param  User $caseHandler
     * @return array
     */
    public function issueApprovalComment(User $caseHandler, $comment, $status)
    {
        return $this->handlers()->syncWithoutDetaching([
            $caseHandler->id    => [
                'approval_status'  => $status,
                'approval_comment' => $comment,
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
                'recommendation'           => $recommendation,
                'approval_requested_at'    => NULL,
                'approval_status'          => NULL,
                'approval_comment'         => NULL,
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

        return $this->handlers()->syncWithoutDetaching([
                    $caseHandler->id     => [
                        'workingon_at'   => now(),
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
        $supervisor_id      = !is_null($supervisor) ? $supervisor->id : auth()->id();
        $previouCaseHandler = $this->handlers->first()->case_handler;

        return $this->handlers()->syncWithoutDetaching([
            $currentCaseHandler->id => [
                'supervisor_id'     => $supervisor_id,
                'dropped_at'        => now()
            ],
            $newCaseHandler->id                 => [
                'supervisor_id'                 => $supervisor_id,
                'workingon_at'                  => $previouCaseHandler->workingon_at,
                'defficiency_issued_at'         => $previouCaseHandler->defficiency_issued_at,
                'defficiency'                   => $previouCaseHandler->defficiency,
                'checklist_approval_issued_at'  => $previouCaseHandler->checklist_approval_issued_at,
                'analysis_document'             => $previouCaseHandler->analysis_document,
                'recommendation_issued_at'      => $previouCaseHandler->recommendation_issued_at,
                'recommendation'                => $previouCaseHandler->recommendation,
                'approval_requested_at'         => $previouCaseHandler->approval_requested_at,
                'approval_status'               => $previouCaseHandler->approval_status,
                'approval_comment'              => $previouCaseHandler->approval_comment,
                'approval_letter_sent_at'       => $previouCaseHandler->approval_letter_sent_at,
                'extension_requested_at'        => $previouCaseHandler->extension_requested_at,
                'extension_reason'              => $previouCaseHandler->extension_reason,
                'archived_at'                   => $previouCaseHandler->archived_at,
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
            ->withPivot(
                'supervisor_id',
                'workingon_at',
                'defficiency_issued_at',
                'defficiency',
                'checklist_approval_issued_at',
                'analysis_document',
                'recommendation_issued_at',
                'recommendation',
                'approval_requested_at',
                'approval_status',
                'approval_comment',
                'approval_letter_sent_at',
                'extension_requested_at',
                'extension_reason',
                'dropped_at',
                'archived_at'
            )->withTimestamps();
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
