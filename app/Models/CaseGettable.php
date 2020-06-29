<?php

namespace App\Models;

trait CaseGettable
{
    public function submittedCases()
    {
        return static::where('submitted_at', '!=', null)->get();
    }

    public function unasignedCases()
    {
        return static::with('handlers')
            ->where('submitted_at', '!=', null)
            ->latest()
            ->get()
            ->reject(function($case)
            {
                return $case->handlers->isEmpty() ? false : true;
            });
    }

    public function asignedCases()
    {
        return static::with(['handlers' => function($query)
            {
                $query->where('dropped_at', '=', null);
            }])
            ->where('submitted_at', '!=', null)
            ->latest()
            ->get()
            ->reject(function($case)
            {
                return $case->handlers->isEmpty() ? true : false;
            });
    }
}
