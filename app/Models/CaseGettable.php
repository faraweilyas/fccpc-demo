<?php

namespace App\Models;

trait CaseGettable
{
    public function submittedCases()
    {
        return static::where('submitted_at', '!=', null)->get();
    }
}
