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
        $this->applicant_fullname       = $contactInfo->applicant_fullname;
        $this->applicant_email          = $contactInfo->applicant_email;
        $this->applicant_phone_number   = $contactInfo->applicant_phone_number;
        $this->applicant_address        = $contactInfo->applicant_address;
        $this->letter_of_appointment    = $contactInfo->letter_of_appointment;
        return $this->save();
    }

    /**
     * Saves fees information
     *
     * @param  \stdClass $feeInfo
     * @return bool
     */
    public function saveFeeInfo(\stdClass $feeInfo) : bool
    {
        $this->amount_paid        = $feeInfo->amount_paid;
        return $this->save();
    }

    /**
     * Saves application forms
     *
     * @param  \stdClass $forms
     * @return bool
     */
    public function saveApplicationForms(\stdClass $forms) : bool
    {
        $this->application_forms   = $forms->application_forms;
        return $this->save();
    }

    /**
     * Saves Declaration
     *
     * @param  \stdClass $declarationInfo
     * @return bool
     */
    public function saveDeclaration(\stdClass $declarationInfo) : bool
    {
        $this->declaration_name        = $declarationInfo->declaration_name;
        $this->declaration_rep         = $declarationInfo->declaration_rep;
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
