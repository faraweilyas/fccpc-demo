<?php

namespace App\Enhancers;

/**
 * AppHelper Class
 */
class AppHelper
{
	/**
	* Generates HTML SELECT button
	* @param string $array
	* @param array $selecteds
	* @param string $textStyle
	* @return void
	*/
	public static function generateSelect(string $array=NULL, array $selecteds=[], string $textStyle=NULL)
	{
		$HTMLOutput = '';
		if (!isset(static::$$array)) return '';
		array_walk(static::$$array, function ($value, $key) use (&$HTMLOutput, $selecteds, $textStyle)
		{
			$selected 	 = (in_array($key, $selecteds)) ? " selected" : '';
			$value 	 	 = !empty($textStyle) ? $textStyle($value) : $value;
			$HTMLOutput .= "<option value='{$key}'{$selected}>{$value}</option>";
		});
		echo $HTMLOutput;
	}

	/**
	* Generates HTML SELECT button with user defined array
	* @param array $array
	* @param array $selecteds
	* @param string $textStyle
	* @return string
	*/
	public static function generateUDASelect(array $array=[], array $selecteds=[], string $textStyle=NULL) : string
	{
		$HTMLOutput = '';
		if (empty($array)) return '';
		array_walk($array, function ($value, $key) use (&$HTMLOutput, $selecteds, $textStyle)
		{
			$selected 	 = (in_array($key, $selecteds)) ? " selected" : '';
			$value 	 	 = !empty($textStyle) ? $textStyle($value) : $value;
			$HTMLOutput .= "<option value='{$key}'{$selected}>{$value}</option>";
		});
		return $HTMLOutput;
	}
	
}