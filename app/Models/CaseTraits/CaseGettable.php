<?php

namespace App\Models\CaseTraits;

trait CaseGettable
{
    /**
     * Gets submitted cases
     *
     * @return Collection
     */
    public function submittedCases()
    {
        return static::where('submitted_at', '!=', null)->get();
    }

    /**
     * Gets cases by type
     *
     * @return Collection
     */
    public function filterCasesByType($type = null)
    {
        return static::where('case_type', $type)->get();
    }

    /**
     * Gets unassigned cases with handlers
     *
     * @return Collection
     */
    public function unassignedCases()
    {
        return static::where('submitted_at', '!=', null)
            ->with('handlers')
            ->latest()
            ->get()
            ->reject(function($case)
            {
                return $case->handlers->isEmpty() ? false : true;
            });
    }

    /**
     * Gets assigned cases with active handlers
     *
     * @return Collection
     */
    public function assignedCases()
    {
        return static::where('submitted_at', '!=', null)
            ->with('active_handlers')
            ->latest()
            ->get()
            ->reject(function($case)
            {
                return $case->active_handlers->isEmpty() ? true : false;
            });
    }

    /**
     * Gets assigned cases with dropped handlers
     *
     * @return Collection
     */
    public function assignedCasesWithDroppedHandlers()
    {
        return static::where('submitted_at', '!=', null)
            ->with('dropped_handlers')
            ->latest()
            ->get()
            ->reject(function($case)
            {
                return $case->dropped_handlers->isEmpty() ? true : false;
            });
    }

    /**
     * Gets archived cases with handlers
     *
     * @return Collection
     */
    public function archivedCases()
    {
        return static::where('submitted_at', '!=', null)
            ->with(['handlers' => function($query)
            {
                $query->where('archived_at', '!=', null);
            }])
            ->latest()
            ->get()
            ->reject(function($case)
            {
                return $case->handlers->isEmpty() ? true : false;
            });
    }
}
