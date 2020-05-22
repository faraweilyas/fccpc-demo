<?php

namespace App\Enhancers;

/**
 * AppHelper Class
 */
class AppHelper
{
	public static $shipping = 150;
	
	// Valid account
	static $accounts = [
		'0' 	=> 'Admin',
		'1' 	=> 'Root'
	];

	// Valid Delivery Status
	static $delivery_status = [
		'1' 	=> 'Pending',
		'2' 	=> 'Approved',
		'3' 	=> 'Cancelled',
		'4' 	=> 'Delivered',
	];

	// Valid Delivery Status HTML
	static $delivery_statusHTML = [
		'1' 	=> 'secondary',
		'2' 	=> 'info',
		'3' 	=> 'warning',
		'4' 	=> 'success',
	];

	// Valid Status
	static $status = [
		'0' 	=> 'Inactive',
		'1' 	=> 'Active',
	];

	// Valid Status HTML
	static $statusHTML = [
		'0' 	=> 'danger',
		'1' 	=> 'success',
	];

	// Valid Payment Types
	static $payment_type = [
		'1' 	=> 'Online Payment',
		'2' 	=> 'Cash On Delivery',
	];

	// Valid Partner Types
	static $partner_type = [
		'1' 	=> 'Restaurant Partner',
		'2' 	=> 'Delivery Partner',
	];

	// Valid Payment Type HTML
	static $payment_typeHTML = [
		'1' 	=> 'success',
		'2' 	=> 'primary',
	];

	// Valid reservation start times
	protected static $start_times = [
		'07:00:00' 	=> '7:00 AM',
		'07:30:00' 	=> '7:30 AM',
		'08:00:00' 	=> '8:00 AM',
		'08:30:00' 	=> '8:30 AM',
		'09:00:00' 	=> '9:00 AM',
		'09:30:00' 	=> '9:30 AM',
		'10:00:00' 	=> '10:00 AM',
		'10:30:00' 	=> '10:30 AM',
		'11:00:00' 	=> '11:00 AM',
		'11:30:00' 	=> '11:30 AM',
		'12:00:00' 	=> '12:00 PM',
		'12:30:00' 	=> '12:30 PM',
		'13:00:00' 	=> '1:00 PM',
		'13:30:00' 	=> '1:30 PM',
		'14:00:00' 	=> '2:00 PM',
		'14:30:00' 	=> '2:30 PM',
		'15:00:00' 	=> '3:00 PM',
		'15:30:00' 	=> '3:30 PM',
		'16:00:00' 	=> '4:00 PM',
		'16:30:00' 	=> '4:30 PM',
		'17:00:00' 	=> '5:00 PM',
		'17:30:00' 	=> '5:30 PM',
		'18:00:00' 	=> '6:00 PM',
		'18:30:00' 	=> '6:30 PM',
		'19:00:00' 	=> '7:00 PM',
		'19:30:00' 	=> '7:30 PM',
		'20:00:00' 	=> '8:00 PM',
		'20:30:00' 	=> '8:30 PM',
		'21:00:00' 	=> '9:00 PM',
		'21:30:00' 	=> '9:30 PM',
		'22:00:00' 	=> '10:00 PM',
		'22:30:00' 	=> '10:30 PM',
		'23:00:00' 	=> '11:00 PM',
		'23:30:00' 	=> '11:30 PM',
		'00:00:00' 	=> '12:00 AM',
		'00:30:00' 	=> '12:30 AM',
	];

	// Valid reservation end times
	protected static $end_times = [
		'07:30:00' 	=> '7:30 AM',
		'08:00:00' 	=> '8:00 AM',
		'08:30:00' 	=> '8:30 AM',
		'09:00:00' 	=> '9:00 AM',
		'09:30:00' 	=> '9:30 AM',
		'10:00:00' 	=> '10:00 AM',
		'10:30:00' 	=> '10:30 AM',
		'11:00:00' 	=> '11:00 AM',
		'11:30:00' 	=> '11:30 AM',
		'12:00:00' 	=> '12:00 PM',
		'12:30:00' 	=> '12:30 PM',
		'13:00:00' 	=> '1:00 PM',
		'13:30:00' 	=> '1:30 PM',
		'14:00:00' 	=> '2:00 PM',
		'14:30:00' 	=> '2:30 PM',
		'15:00:00' 	=> '3:00 PM',
		'15:30:00' 	=> '3:30 PM',
		'16:00:00' 	=> '4:00 PM',
		'16:30:00' 	=> '4:30 PM',
		'17:00:00' 	=> '5:00 PM',
		'17:30:00' 	=> '5:30 PM',
		'18:00:00' 	=> '6:00 PM',
		'18:30:00' 	=> '6:30 PM',
		'19:00:00' 	=> '7:00 PM',
		'19:30:00' 	=> '7:30 PM',
		'20:00:00' 	=> '8:00 PM',
		'20:30:00' 	=> '8:30 PM',
		'21:00:00' 	=> '9:00 PM',
		'21:30:00' 	=> '9:30 PM',
		'22:00:00' 	=> '10:00 PM',
		'22:30:00' 	=> '10:30 PM',
		'23:00:00' 	=> '11:00 PM',
		'23:30:00' 	=> '11:30 PM',
		'00:00:00' 	=> '12:00 AM',
		'00:30:00' 	=> '12:30 AM',
		'01:00:00' 	=> '01:00 AM',
	];

	static $valid_states = array(
    "ABUJA_FCT"        => "ABUJA FCT",
    "ABIA"             => "ABIA",
    "ADAMAWA"          => "ADAMAWA",
    "AKWA IBOM"        => "AKWA IBOM",
    "ANAMBRA"          => "ANAMBRA",
    "BAUCHI"           => "BAUCHI",
    "BAYELSA"          => "BAYELSA",
    "BENUE"            => "BENUE",
    "BORNO"            => "BORNO",
    "CROSS_RIVER"      => "CROSS RIVER",
    "DELTA"            => "DELTA",
    "EBONYI"           => "EBONYI",
    "EDO"              => "EDO",
    "EKITI"            => "EKITI",
    "ENUGU"            => "ENUGU",
    "GOMBE"            => "GOMBE",
    "IMO"              => "IMO",
    "JIGAWA"           => "JIGAWA",
    "KADUNA"           => "KADUNA",
    "KANO"             => "KANO",
    "KATSINA"          => "KATSINA",
    "KEBBI"            => "KEBBI",
    "KOGI"             => "KOGI",
    "KWARA"            => "KWARA",
    "LAGOS"            => "LAGOS",
    "NASSARAWA"        => "NASSARAWA",
    "NIGER"            => "NIGER",
    "OGUN"             => "OGUN",
    "ONDO"             => "ONDO",
    "OSUN"             => "OSUN",
    "OYO"              => "OYO",
    "PLATEAU"          => "PLATEAU",
    "RIVERS"           => "RIVERS",
    "SOKOTO"           => "SOKOTO",
    "TARABA"           => "TARABA",
    "YOBE"             => "YOBE",
    "ZAMFARA"          => "ZAMFARA"
	);
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