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
        return (\AppHelper::validateKey('case_types', $type)) ? static::where('case_type', $type)->get() : [];
    }

    /**
     * Gets cases by category
     *
     * @return Collection
     */
    public function filterCasesByCategory($category = null)
    {
        return (\AppHelper::validateKey('case_categories', $category)) ? static::where('case_category', $category)->get() : [];
    }

    /**
     * Gets case by date range
     *
     * @return Collection
     */
    public function getCaseByDateRange($start_date, $end_date)
    {
        return static::whereBetween('submitted_at', [$start_date, $end_date])->with('handlers')
            ->latest()
            ->get()
            ->reject(function($case)
            {
                return $case->handlers->isEmpty() ? true : false;
            });
    }

    /**
     * Gets case by date range, type and category
     *
     * @return Collection
     */
    public function getCaseByDateRangeTypeAndCategory($start_date, $end_date, $category, $type)
    {
        return static::whereBetween('submitted_at', [$start_date, $end_date])
            ->where('case_category', $category)->where('case_type', $type)
            ->with('handlers')
            ->latest()
            ->get()
            ->reject(function($case)
            {
                return $case->handlers->isEmpty() ? true : false;
            });
    }

    /**
     * Gets case by date range & case handler
     *
     * @return Collection
     */
    public function getCaseByDateRangeAndHandler($start_date, $end_date, $handler_id)
    {
         return static::whereBetween('submitted_at', [$start_date, $end_date])
            ->with(['handlers' => function($query) use ($handler_id)
            {
                $query->whereIn('handler_id', $handler_id);
            }])
            ->latest()
            ->get()
            ->reject(function($case)
            {
                return $case->handlers->isEmpty() ? true : false;
            });
    }

    /**
     * Gets case by date range & case handler, type and category
     *
     * @return Collection
     */
    public function getCaseByDateRangeTypeCategoryAndHandler($start_date, $end_date, $handler_id, $category, $type)
    {
         return static::whereBetween('submitted_at', [$start_date, $end_date])
            ->where('case_category', $category)->where('case_type', $type)
            ->with(['handlers' => function($query) use ($handler_id)
            {
                $query->whereIn('handler_id', $handler_id);
            }])
            ->latest()
            ->get()
            ->reject(function($case)
            {
                return $case->handlers->isEmpty() ? true : false;
            });
    }

    /**
     * Gets case by category & type
     *
     * @return Collection
     */
    public function getCaseByCategoryAndType($category, $type)
    {
         return static::where('case_category', $category)->where('case_type', $type)
            ->with('handlers')
            ->latest()
            ->get()
            ->reject(function($case)
            {
                return $case->handlers->isEmpty() ? true : false;
            });
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
     * Gets search assigned cases with active handlers
     *
     * @return Collection
     */
    public function searchAssignedCases($search)
    {
        return static::where('submitted_at', '!=', null)
            ->where('subject', 'LIKE', '%'.$search.'%')
            ->with('active_handlers')
            ->latest()
            ->get()
            ->reject(function($case)
            {
                return $case->active_handlers->isEmpty() ? false : true;
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
