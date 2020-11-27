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

    protected $status = [
        'inactive' => 'Inactive',
        'active'   => 'Active',
    ];

    protected $status_html = [
        'inactive' => 'danger',
        'active'   => 'success',
    ];

	protected $case_categories = [
		"REG" => "Domestic",
		"FFM" => "FFM",
		"FFX" => "FFM - Expedited",
	];

    protected $case_categories_text = [
        "REG" => "Domestic Merger",
        "FFM" => "Foreign to Foreign Merger",
        "FFX" => "Foreign to Foreign Merger (Expedited)",
    ];

    protected $case_categories_html = [
        "REG" => "warning",
        "FFM" => "dark",
        "FFX" => "danger",
    ];

    protected $case_types = [
        "SM" => "Small",
        "LG" => "Large",
    ];

    protected $case_types_html = [
        "SM" => "info",
        "LG" => "danger",
    ];

	protected $case_status = [
		"1"  => "Unassigned",
		"2"  => "Assigned",
		"3"  => "On Hold",
		"4"  => "Approved",
		"5"  => "Rejected",
	];

	protected $case_status_html = [
		"1"  => "secondary",
		"2"  => "info",
		"3"  => "warning",
		"4"  => "success",
		"5"  => "danger",
	];

    protected $file_groups = [
        "COM" => "Company",
        "ACC" => "Account",
        "PAY" => "Payment",
    ];

    protected $enquiry_types = [
        "GEN" => "General",
        "PRN" => "Pre-Notification",
        "COP" => "Complaint",
    ];

    protected $enquiry_types_html = [
        "GEN"  => "primary",
        "PRN"  => "secondary",
        "COP"  => "warning",
    ];

    protected $faq_categories = [
        "GEN" => "General",
        "GES" => "Getting Started"
        // "ENQ" => "Enquiry",
    ];

    protected $faq_categories_html = [
        "GEN" => "primary",
        "GES" => "warning"
        // "ENQ" => "secondary",
    ];

    protected $faq_categories_description = [
        "GEN" => "General information about our patform, our clients, and security",
        "GES" => "Everything you need to know about getting started on our platform"
        // "ENQ" => "Get Relevant information on application cases",
    ];

    protected $feedbacks = ["Yes", "No"];

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
