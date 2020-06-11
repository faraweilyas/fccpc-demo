<?php

namespace App\Enhancers;

/**
 * AppHelper Class
 */
class AppHelper
{
	// Valid Case Categories
	static $case_categories = [
		"RG"  => "Regular",
		"FFM" => "FFM",
		"FFX" => "FFM-Expediated",
	];

	// Valid Case Status
	static $case_status = [
		"1"  => "New",
		"2"  => "Assigned",
		"3"  => "On Hold",
		"4"  => "Approved",
		"5"  => "Rejected",
	];

	// Valid Case Status
	static $case_statusHTML = [
		"1"  => "secondary",
		"2"  => "info",
		"3"  => "warning",
		"4"  => "success",
		"5"  => "danger",
	];

	// Valid Status
	static $status = [
		'0' => 'Inactive',
		'1' => 'Active',
	];

	// Valid Status HTML
	static $statusHTML = [
		'0' => 'danger',
		'1' => 'success',
	];

	// Valid Case Categories
	static $account_types = [
		"AD"  => "Admin",
		"IT"  => "It",
		"SP"  => "Supervisor",
		"CH"  => "Case Handler",
	];

	// Valid Case Categories
	static $account_typesHTML = [
		"AD"  => "danger",
		"SP"  => "primary",
		"IT"  => "warning",
		"CH"  => "info",
	];

    // Valid enquiry type
    static $enquiry_types = [
        "GEN"  => "General",
        "PRE"  => "Pre-Notification",
    ];

	/**
	* Validates array key
	* @param string $array
	* @param string $arrayKey
	* @return bool
	*/
	public static function validateArrayKey (string $array=NULL, string $arrayKey=NULL) : bool
	{
		if (!isset(static::$$array)) return FALSE;
		return array_key_exists(strtoupper($arrayKey), static::$$array);
	}

	/**
	* Validates and returns array
	* @param string $array
	* @param string $textStyle
	* @return array
	*/
	public static function getArray (string $array=NULL, string $textStyle="strtoupper") : array
	{
		if (!isset(static::$$array)) return [];
		foreach (static::$$array as &$arrayValue):
			$arrayValue = !empty($textStyle) ? $textStyle($arrayValue) : $arrayValue;
		endforeach;
		return static::$$array;
	}

	/**
	* Validates and returns array value
	* @param string $array
	* @param string $arrayKey
	* @param string $textStyle
	* @return string
	*/
	public static function getArrayValue (string $array=NULL, string $arrayKey=NULL, string $textStyle="strtoupper") : string
	{
		if (!isset(static::$$array)) return '';
		if (empty($arrayKey)) return '';
		if (static::validateArrayKey($array, $arrayKey))
			return !empty($textStyle) ? $textStyle(static::$$array[strtoupper($arrayKey)]) : static::$$array[strtoupper($arrayKey)];
		else
			return "";
	}

	/**
	* Generates HTML SELECT button
	* @param string $array
	* @param string $select
	* @return string
	*/
	public static function generateSelect (string $array=NULL, string $select=NULL) : string
	{
		$HTMLOutput = '';
		if (!isset(static::$$array)) return '';
		array_walk(static::$$array, function ($value, $key) use (&$HTMLOutput, $select)
		{
			$selected 	 = (strtoupper($select) == $key) ? " selected" : "";
			$HTMLOutput .= "<option value='{$key}'$selected>".ucwords($value)."</option>";
		});
		return $HTMLOutput;
	}

	/**
	* Generates HTML SELECT button for user defined array
	* @param array $array
	* @param array $selecteds
	* @return string
	*/
	public static function generateUDASelect (array $array=[], array $selecteds=[]) : string
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
	* @param array $array
	* @param array $properties
	* @param array $selecteds
	* @param string $textStyle
	* @return string
	*/
	public static function generateObjSelect(array $array=[], array $properties=[], array $selecteds=[], string $textStyle=NULL) : string
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
	* @param string $array
	* @param string $select
	* @return string
	*/
	public static function generateRadio (string $array=NULL, string $select=NULL, bool $isRequired=TRUE) : string
	{
		$HTMLOutput = '';
		$id 		= 1;
		if (!isset(static::$$array)) return '';
		foreach (static::$$array as $key => $value):
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
