<?php

namespace App\Enhancers;

/**
 * AppHelper Class
 */
class AppHelper
{
    /**
     * $app App instance
     * @var null|Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Loads the app instance into scope
     *
     * @param null|Illuminate\Foundation\Application $app
     * @return void
     */
    public function __construct($app=null)
    {
        $this->app = is_null($app) ? app() : $app;
    }

    /**
     * Valid account types
     *
     * These are the valid account types on the platform
     */
    protected $account_types = [
        "RT"  => "Root",
        "AD"  => "Admin",
        "RG"  => "Registrar",
        "IT"  => "IT Personnel",
        "DG"  => "Director General",
        "SP"  => "Supervisor",
        "CH"  => "Case Handler",
        "DE"  => "Data Entry",
        "AP"  => "Applicant",
    ];

    /**
     * Valid _css_colors_ for account types
     *
     * These are the valid _css_colors_ for account types on the platform
     */
    protected $account_types_html = [
        "RT"  => "danger",
        "AD"  => "warning",
        "RG"  => "info",
        "IT"  => "primary",
        "DG"  => "info",
        "SP"  => "info",
        "CH"  => "info",
        "DE"  => "info",
        "AP"  => "info",
    ];

    /**
     * Valid status
     *
     * These are the valid status on the platform
     */
    protected $status = [
        'inactive' => 'Inactive',
        'active'   => 'Active',
    ];

    /**
     * Valid _css_colors_ for status
     *
     * These are the valid _css_colors_ for status on the platform
     */
    protected $status_html = [
        'inactive' => 'danger',
        'active'   => 'success',
    ];

    /**
     * Valid recommendations
     *
     * These are the valid recommendations on the platform
     */
    protected $recommendation_types = [
        'Approve'   => 'Approved',
        'Reject'    => 'Rejected',
    ];

    /**
     * Valid case categories
     *
     * These are the valid case categories on the platform
     */
	protected $case_categories = [
		"REG" => "MRR Form 1 (Regular)",
		"FFM" => "MRR Form 2 (Simplified Procedure)",
		"FFX" => "MRR Form 4 (Negative Clearance)",
	];

    /**
     * Valid case/application categories key
     *
     * These are the valid case categories key on the platform
     */
    protected $case_categories_text = [
        "REG" => "MRR Form 1 (Regular)",
        "FFM" => "MRR Form 2 (Simplified Procedure)",
        "FFX" => "MRR Form 4 (Negative Clearance)",
    ];

    /**
     * Valid _css_colors_ for case categories key
     *
     * These are the valid _css_colors_ for case categories on the platform
     */
    protected $case_categories_html = [
        "REG" => "warning",
        "FFM" => "dark",
        "FFX" => "danger",
    ];

    /**
     * Valid case types
     *
     * These are the valid case types on the platform
     */
    protected $case_types = [
        "SM" => "Small Merger",
        "LG" => "Large Merger",
    ];

    /**
     * Valid _css_colors_ for case types
     *
     * These are the valid _css_colors_ for case types on the platform
     */
    protected $case_types_html = [
        "SM" => "info",
        "LG" => "danger",
    ];

    /**
     * Valid case status
     *
     * These are the valid case status on the platform
     */
	protected $case_status = [
		"1"  => "Unassigned",
		"2"  => "Assigned",
		"3"  => "On Hold",
		"4"  => "Approved",
		"5"  => "Rejected",
	];

    /**
     * Valid _css_colors_ for case status
     *
     * These are the valid _css_colors_ for case status on the platform
     */
	protected $case_status_html = [
		"1"  => "secondary",
		"2"  => "info",
		"3"  => "warning",
		"4"  => "success",
		"5"  => "danger",
	];

    /**
     * Valid file groups
     *
     * These are the valid file groups on the platform
     */
    protected $file_groups = [
        "COM" => "Company",
        "ACC" => "Account",
        "PAY" => "Payment",
    ];

    /**
     * Valid enquiry type
     *
     * These are the valid enquiry types on the platform
     */
    protected $enquiry_types = [
        "GEN" => "General Consultation",
        "PRN" => "Pre-Notification Consultation",
        "COP" => "Complaint Consultation",
    ];

    /**
     * Valid _css_colors_ for enquiry types
     *
     * These are the valid _css_colors_ for enquiry types on the platform
     */
    protected $enquiry_types_html = [
        "GEN"  => "primary",
        "PRN"  => "secondary",
        "COP"  => "warning",
    ];

    /**
     * Valid faq categories
     *
     * These are the valid faq categories on the platform
     */
    protected $faq_categories = [
        "GEN" => "General",
        "GES" => "Getting Started"
        // "ENQ" => "Enquiry",
    ];

    /**
     * Valid _css_colors_ for faq categories
     *
     * These are the valid _css_colors_ for faq categories on the platform
     */
    protected $faq_categories_html = [
        "GEN" => "primary",
        "GES" => "warning"
        // "ENQ" => "secondary",
    ];

    /**
     * Valid faq categories matching key descriptions
     *
     * These are the valid faq categories matching key descriptions on the platform
     */
    protected $faq_categories_description = [
        "GEN" => "General information about our patform, our clients, and security",
        "GES" => "Everything you need to know about getting started on our platform"
        // "ENQ" => "Get Relevant information on application cases",
    ];

    /**
     * Valid feedbacks
     *
     * These are the valid feedbacks on the platform
     */
    protected $feedbacks = ["Yes", "No"];

    /**
     * Valid notification types
     *
     * These are the valid notification types on the platform
     */
    protected $notification_types = [
        "NEWUSER"                => "New User",
        "NEW_PUBLICATION"        => "New Publication",
        "APPROVED_DOC"           => "Case Approved for Documentation",
        "NEWENQUIRY"             => "New Pre-Notification",
        "NEWIDREQUEST"           => "New Application ID Request",
        "NEWCASE"                => "New Case",
        "ASSIGN"                 => "New Case Assigned",
        "REASSIGN"               => "Case Reassigned",
        "UNASSIGN"               => "Case Unassigned",
        "ARCHIVE"                => "Case Archived",
        "ONHOLD"                 => "Case on Hold",
        "DEFRESPONSE"            => "Response to Deficiency",
        "REQUEST"                => "Approval Request",
        "REQUEST_APPROVED"       => "Approved Request",
        "REQUEST_REJECTED"       => "Rejected Request",
    ];

    /**
     * Valid _css_colors_ for notification types
     *
     * These are the valid _css_colors_ for notification types on the platform
     */
    protected $notification_types_styles = [
        "NEWUSER"                => "success",
        "NEW_PUBLICATION"        => "primary",
        "APPROVED_DOC"           => "success",
        "NEWENQUIRY"             => "secondary",
        "NEWIDREQUEST"           => "secondary",
        "NEWCASE"                => "primary",
        "ASSIGN"                 => "secondary",
        "REASSIGN"               => "primary",
        "UNASSIGN"               => "danger",
        "ARCHIVE"                => "warning",
        "ONHOLD"                 => "warning",
        "DEFRESPONSE"            => "success",
        "REQUEST"                => "warning",
        "REQUEST_APPROVED"       => "success",
        "REQUEST_REJECTED"       => "danger",
    ];

    /**
     * Valid application form
     *
     * These are the application forms on the platform
     */
    protected $application_forms = [
        "form1"     => "Notice of Merger Form 1",
        "form2"     => "Simplified Procedure Form 2",
        "form4"     => "Negative Clearance Form 4",
    ];

	/**
	 * Validates array key
     *
	 * @param string $array
	 * @param mixed $arrayKey
	 * @return bool
	 */
	public function validateKey(string $array, $arrayKey) : bool
	{
        if (!isset($this->$array) || is_null($arrayKey))
            return FALSE;

		return array_key_exists($arrayKey, $this->$array);
	}

    /**
     * Validates array value
     *
     * @param string $array
     * @param mixed $arrayValue
     * @return bool
     */
    public function validateValue(string $array, $arrayValue) : bool
    {
        if (!isset($this->$array) || is_null($arrayValue))
            return FALSE;

        return in_array($arrayValue, $this->$array);
    }

	/**
	 * Validates and returns array
     *
	 * @param string $array
	 * @param mixed $textStyle
	 * @return array
	 */
	public function get(string $array, $textStyle="strtoupper") : array
	{
		if (!isset($this->$array)) return [];
        return collect($this->$array)->map(function($value, $key) use ($textStyle)
        {
            return textTransformer($value, $textStyle);
        })->toArray();
	}

    /**
     * Get array keys
     *
     * @param string $array
     * @param mixed $textStyle
     * @return array
     */
    public function keys(string $array, $textStyle="strtoupper") : array
    {
        return array_keys($this->get($array, $textStyle));
    }

    /**
     * Validates and returns array value
     *
     * @param string $array
     * @param mixed $arrayValue
     * @return mixed
     */
    public function key(string $array, $arrayValue)
    {
        if (!isset($this->$array) || is_null($arrayValue))
            return NULL;
        if (!$this->validateValue($arrayValue, $array))
            return NULL;

        return array_search($arrayValue, $array);
    }

    /**
     * Get array values
     *
     * @param string $array
     * @param mixed $textStyle
     * @return array
     */
    public function values(string $array, $textStyle=NULL) : array
    {
        return array_values($this->get($array, $textStyle));
    }

	/**
	 * Validates and returns array value
     *
	 * @param string $array
	 * @param mixed $arrayKey
	 * @param mixed $textStyle
	 * @return mixed
	 */
	public function value(string $array, $arrayKey, $textStyle=NULL)
	{
		if (!isset($this->$array) || is_null($arrayKey))
            return NULL;
		if (!$this->validateKey($array, $arrayKey))
            return NULL;

        return textTransformer($this->$array[$arrayKey], $textStyle);
	}

	/**
	 * Generates HTML SELECT button
     *
	 * @param string $array
	 * @param string $select
	 * @return string
	 */
	public function select(string $array=NULL, string $select=NULL) : string
	{
		$HTMLOutput = '';
		if (!isset($this->$array)) return '';
		array_walk($this->$array, function ($value, $key) use (&$HTMLOutput, $select)
		{
			$selected 	 = (strtoupper($select) == $key) ? " selected" : "";
			$HTMLOutput .= "<option value='{$key}'$selected>".ucwords($value)."</option>";
		});
		return $HTMLOutput;
	}

	/**
	 * Generates HTML SELECT button for user defined array
     *
	 * @param array $array
	 * @param array $selecteds
	 * @return string
	 */
	public function udaSelect(array $array=[], array $selecteds=[]) : string
	{
		$HTMLOutput = '';
		if (empty($array)) return '';
		array_walk($array, function ($value, $key) use (&$HTMLOutput, $selecteds)
		{
			$selected 	 = (in_array($key, $selecteds)) ? " selected" : "";
			$HTMLOutput .= "<option value='{$key}'$selected>".ucwords($value)."</option>";
		});
		return $HTMLOutput;
	}

	/**
	 * Generates HTML SELECT button for custom arrays with objects
     *
	 * @param array $array
	 * @param array $properties
	 * @param array $selecteds
	 * @param string $textStyle
	 * @return string
	 */
	public function objSelect(array $array=[], array $properties=[], array $selecteds=[], string $textStyle=NULL) : string
	{
		$HTMLOutput = '';
		if (empty($array) || empty($properties)) return '';
		array_walk($array, function ($object, $key) use (&$HTMLOutput, $properties, $selecteds, $textStyle)
		{
			$selectValue 	= $properties[0];
			$selectValue 	= $object->$selectValue ?? "";
			$selected 	 	= (in_array($selectValue, $selecteds)) ? " selected" : '';
			$selectText 	= "";
			// Unset the select value so you can use the properties array dynamically to get the select text
			unset($properties[0]);
			foreach ($properties as $property):
				if (empty($selectText)):
					$selectText .= !empty($object->$property ?? "") ? "{$object->$property} " : "";
				endif;
			endforeach;
			$selectText	= trim((empty($selectText)) ? "" : $selectText);
			$selectText	= !empty($textStyle) ? $textStyle($selectText) : $selectText;
			$HTMLOutput	.= "<option value='{$selectValue}'{$selected}>{$selectText}</option>";
		});
		return $HTMLOutput;
	}

	/**
	 * Generates HTML RADIO button
     *
	 * @param string $array
	 * @param string $select
	 * @return string
	 */
	public function radio(string $array=NULL, string $select=NULL, bool $isRequired=TRUE) : string
	{
		$HTMLOutput = '';
		$id 		= 1;
		if (!isset($this->$array)) return '';
		foreach ($this->$array as $key => $value):
			if (strpos($select, '-') !== FALSE) $select = explode("-", $select)[0];
			$dataValue 	 = "data-value='".strtoupper($value)."'";
			$checked 	 = (strtoupper($select) == $key) ? " checked='checked'" : "";
			$HTMLOutput .= "<label>";
			$HTMLOutput .= "<input name='$array' class='$array'$checked id='$array$id' $dataValue value='$key' type='radio' ";
            if ($isRequired == TRUE) $HTMLOutput .= "required ";
			$HTMLOutput .= "/>&nbsp;".strtoupper($value)."</label>"; $id++;
		endforeach;
		return $HTMLOutput;
	}
}
