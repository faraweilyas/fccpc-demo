<?php

namespace App\Models;

trait CaseAssignable
{
    public function assign(User $caseHandler, User $supervisor = null)
    {
        $supervisor_id = !is_null($supervisor) ? $supervisor->id : auth()->id();

        return $this->handlers()->syncWithoutDetaching([$caseHandler->id => [
            'supervisor_id' => $supervisor_id
        ]]);
    }

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

    public function retract(User $caseHandler, User $supervisor = null)
    {
        $supervisor_id = !is_null($supervisor) ? $supervisor->id : auth()->id();

        return $this->handlers()->syncWithoutDetaching([$caseHandler->id => [
            'supervisor_id' => $supervisor_id,
            'dropped_at'    => now()
        ]]);
    }

    public function disolve(User $caseHandler)
    {
        return $this->handlers()->detach($caseHandler);
    }

    public function handlers()
    {
        return $this->belongsToMany(User::class, 'case_handler', 'case_id', 'handler_id')
            ->withPivot('supervisor_id', 'dropped_at')
            ->as('handler')
            ->withTimestamps();
    }

    public function handler()
    {
        return $this->handlers()->where('dropped_at', null);
    }

    public function droppedHandlers()
    {
        return $this->handlers()->where('dropped_at', '!=', null);
    }

    public function supervisors()
    {
        return $this->belongsToMany(User::class, 'case_handler', 'case_id', 'supervisor_id')
            ->as('supervisor')
            ->withPivot('handler_id', 'dropped_at')
            ->withTimestamps();
    }

    public function supervisor()
    {
        return $this->supervisors()->where('dropped_at', null);
    }
}
