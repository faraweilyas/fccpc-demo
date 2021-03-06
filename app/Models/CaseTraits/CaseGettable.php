<?php

namespace App\Models\CaseTraits;

use App\Models\RequestID;

trait CaseGettable
{
    /**
     * Gets submitted cases
     *
     * @return Collection
     */
    public function submittedCases()
    {
        return static::where('submitted_at', '!=', null)->latest()->get();
    }

    /**
     * Gets cases by type
     *
     * @param String $type
     * @return Collection
     */
    public function filterCasesByType($type = null)
    {
        return (\AppHelper::validateKey('case_types', $type)) ? static::where('case_type', $type)->where('submitted_at', '!=', NULL)->get() : [];
    }

    /**
     * Gets cases by category
     *
     * @param String $category
     * @return Collection
     */
    public function filterCasesByCategory($category = null)
    {
        return (\AppHelper::validateKey('case_categories', $category)) ? static::where('case_category', $category)->where('submitted_at', '!=', NULL)->get() : [];
    }

    /**
     * Gets cases by category
     *
     * @param String $category
     * @return Collection
     */
    public function getCasesByCategory($category = null)
    {
        return (\AppHelper::validateKey('case_categories', $category))
            ? static::where('case_category', $category)->where('submitted_at', '!=', NULL)->get()
            : [];
    }

    /**
     * Gets suggested cases by request id
     *
     * @param int $request_id
     * @return Collection
     */
    public function getSuggestedCases($request_id)
    {
        $request          = RequestID::find($request_id);

        return static::where('subject', 'LIKE', '%'.$request->subject.'%')
                    ->where('case_category', 'LIKE', '%'.$request->category.'%')
                    ->where('parties', 'LIKE', '%'.$request->parties.'%')
                    ->where('case_type', 'LIKE', '%'.$request->type.'%')
                    ->latest()
                    ->get()
                    ->reject(function($case)
                    {
                        return $case->submitted_at == null;
                    });
    }

    /**
     * Gets cases by type
     *
     * @param String $type
     * @return Collection
     */
    public function getCasesByType($type = null)
    {
        return (\AppHelper::validateKey('case_types', $type))
            ? static::where('case_type', $type)->where('submitted_at', '!=', NULL)->get()
            : [];
    }

    /**
     * Gets total amount paid by month and category
     *
     * @param int $month
     * @param string $category
     * @param string $case_type
     *
     * @return int
     */
    public function getTotalAmountByMonthAndCategory($month, $category, $case_type)
    {
        $cases = $this
                    ->whereMonth('submitted_at', $month)
                    ->where('case_category', $category)
                    ->where('case_type', $case_type)
                    ->get();

        return collect($cases)->sum('amount_paid');
    }

    /**
     * Gets defficeincy issued at date
     *
     * @param String $format
     * @return string
     */
    public function getDefficiencyDate(string $format='customdate')
    {
        if (!$this->active_handlers->first())
            return '';

        $defficiency_date = $this->active_handlers->first()->case_handler->defficiency_issued_at;
        if(!empty($defficiency_date)):
           return datetimeToText($this->active_handlers->first()->case_handler->defficiency_issued_at, $format);
        else:
           return '';
       endif;
    }

    /**
     * Gets checklist approved at date
     *
     * @param String $format
     * @return string
     */
    public function getChecklistApprovedDate(string $format='customdate')
    {
        if (!$this->active_handlers->first())
            return '';

        $approved_date = $this->active_handlers->first()->case_handler->checklist_approval_issued_at;
        if(!empty($approved_date)):
           return datetimeToText($this->active_handlers->first()->case_handler->checklist_approval_issued_at, $format);
        else:
           return '';
       endif;
    }

    /**
     * Gets recommendation issued date
     *
     * @return string
     */
    public function getRecommendationIssuedDate()
    {
        if (!$this->active_handlers->first())
            return '';

        return $this->active_handlers->first()->case_handler->recommendation_issued_at;
    }

    /**
     * Gets recommendation
     *
     * @return string
     */
    public function getRecommendation()
    {
        if (!$this->active_handlers->first())
            return '';

        return $this->active_handlers->first()->case_handler->recommendation;
    }

    /**
     * Gets approval comment
     *
     * @return string
     */
    public function getApprovalComment()
    {
        if (!$this->active_handlers->first())
            return '';

        return $this->active_handlers->first()->case_handler->approval_comment ?? '...';
    }

    /**
     * Gets analysis document
     *
     * @return string
     */
    public function getAnalysisDocument()
    {
        if (!$this->active_handlers->first())
            return '';

        return $this->active_handlers->first()->case_handler->analysis_document;
    }

    /**
     * Gets case by date range
     *
     * @param String $start_date
     * @param String $end_date
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
     * @param String $start_date
     * @param String $end_date
     * @param String $category
     * @param String $type
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
     * @param String $start_date
     * @param String $end_date
     * @param int $handler_id
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
     * @param String $start_date
     * @param String $end_date
     * @param int $handler_id
     * @param String $category
     * @param String $type
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
     * @param String $category
     * @param String $type
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
                return ($case->active_handlers->isEmpty()) ? true : false;
            });
    }

    /**
     * Gets search assigned cases with active handlers
     *
     * @param String $search
     * @return Collection
     */
    public function searchAssignedCases($search)
    {
        return static::where('submitted_at', '!=', null)
            ->where('subject', 'LIKE', '%'.$search.'%')
            ->orWhere('parties', 'LIKE', '%'.$search.'%')
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
