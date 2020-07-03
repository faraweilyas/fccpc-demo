<?php

namespace App\Models\CaseTraits;

trait CaseSaveable
{
    /**
     * Saves case category
     *
     * @param  string $case_category
     * @return bool
     */
    public function saveCategory(string $case_category) : bool
    {
        $this->case_category = strtoupper($case_category);
        return $this->save();
    }

    /**
     * Saves case information
     *
     * @param  string $subject
     * @param  string $parties
     * @param  string $case_type
     * @return bool
     */
    public function saveCaseInfo($subject, $parties, $case_type) : bool
    {
        $this->subject      = $subject;
        $this->parties      = $parties;
        $this->case_type    = $case_type;
        return $this->save();
    }

    /**
     * Saves contact information
     *
     * @param  \stdClass $contactInfo
     * @return bool
     */
    public function saveContactInfo(\stdClass $contactInfo) : bool
    {
        $this->applicant_firm           = $contactInfo->applicant_firm;
        $this->applicant_first_name     = $contactInfo->applicant_first_name;
        $this->applicant_last_name      = $contactInfo->applicant_last_name;
        $this->applicant_email          = $contactInfo->applicant_email;
        $this->applicant_phone_number   = $contactInfo->applicant_phone_number;
        $this->applicant_address        = $contactInfo->applicant_address;
        return $this->save();
    }

    /**
     * Submits case
     *
     * @return bool
     */
    public function submit() : bool
    {
        $this->reference_number = \SerialNumber::referenceNumber();
        $this->submitted_at     = now();
        return $this->save();
    }
}