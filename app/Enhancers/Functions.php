<?php

/**
* Get Host Url.
* @param {}
* @return string
*/
function getHostUrl ()
{
	if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
		$link = "https";
	else 
		$link = "http";

	$link .= "://";
	$link .= $_SERVER['HTTP_HOST'];

	return $link;
}

/**
* Configure Page Headers
* @param string title
* @return array
*/
function details($title)
{
	$details = [
		'title' => APP_NAME.' - '.$title
	];

	return $details;
}

/**
 * Formats a given number
 * @param mixed $number
 * @param bool $round
 * @return string
 */
function formatNumber($number, bool $round=FALSE) : string
{
    if (!$round)
        return number_format($number, 2, '.', ',');
    else
        return stripper(number_format($number, 2, '.', ','), 3);
}

/**
 * Formats a given digit
 * @param mixed $digit
 * @param bool $round
 * @param mixed $prefix
 * @return string
 */
function formatDigit($digit, bool $round=FALSE, $prefix="&#8358;") : string
{
    if (!$round)
        return $prefix.number_format($digit, 2, '.', ',');
    else
        return stripper($prefix.number_format($digit, 2, '.', ','), 3);
}

/**
 * Removes some part of a given string starting from the end
 * @param string $value
 * @param int $length
 * @return string
 */
function stripper(string $value, int $length=1) : string
{
    $valueLength = strlen(trim($value));
    return substr($value, 0, $valueLength - $length);
}

/**
 * Shortens parsed content and appends "..." at the end of the content indicating it was shortened.
 * @param string $content
 * @param int $fixedLength
 * @return string
 */
function shortenContent(string $content, int $fixedLength) : string
{
    $content = trim($content);
    if (strlen($content) < $fixedLength) return $content;
    return trim(substr($content, 0, $fixedLength - 3))."...";        
}

/**
 * Remove invalid Characters from given value
 * @param array $invalidChars
 * @param mixed $value
 * @return mixed
 */
function removeInvalidChar(array $invalidChars, $value)
{
    foreach ($invalidChars as $invalidChar):
        $value = str_replace($invalidChar, "", $value);
    endforeach;
    return $value;
}

/**
* Reformat date
* @param string $dateTime
* @param string $format
* @return string
*/
function reFormatDate (string $date=NULL, string $format="d-m-Y") : string
{
	$date = trim($date);
	if (empty($date)) return "";
	if ((bool) strtotime($date))
		return (new DateTime($date))->format($format);
	else
		return "";
}

/**
* Get random color
* @return string
*/
function getRandomColor() : string
{
	$colors = ['#0071c5', '#40E0D0', '#008000', '#FFD700', '#FF8C00', '#FF0000'];
	return $colors[rand(0, count($colors) - 1)];
}

/**
* Datetiime converter
* @param string $dateTime
* @param string $format
* @return string
*/
function datetimeToText (string $datetime, string $format="fulldate") : string
{
	$unixdatetime   = strtotime($datetime);
	$dateFormat     = "";
	switch (strtolower($format))
	{
		case 'fulldate':
			$dateFormat = "%d %B, %Y at %I:%M %p";
			break;
		case 'date':
			$dateFormat = "%m/%d/%Y";
			break;
		case 'mysql-date':
			$dateFormat = "%m-%d-%Y";
			break;
		case 'customd':
			$dateFormat = "%d %B. %Y";
			break;
		case 'customdate':
			$dateFormat = "%d %b. %Y";
			break;
		case 'customdated':
			$dateFormat = "%d %b %Y";
			break;
		case 'monthyear':
			$dateFormat = "%b. %Y";
			break;
		case 'time':
			$dateFormat = "%I:%M %p";
			break;
		case 'datetime':
			$dateFormat = "%m/%d/%Y %H:%M:%S %p";
			break;
		case 'datefm':
			$dateFormat = "%d/%m/%Y";
			break;
		case 'datefms':
			$dateFormat = "%d-%m-%Y";
			break;
		case 'datef':
			$dateFormat = "%d/%m/%Y %H:%M:%S %p";
			break;
		case 'mysql-datetime':
			$dateFormat = "%m-%d-%Y %H:%M:%S";
			break;
		case 'word-datetime':
			$dateFormat = "%a %d %b %I:%M %p";
			break;
		case 'word-date':
			$dateFormat = "%d %b %Y";
			break;
		case 'fullday':
			$dateFormat = "%A";
			break;
		case 'day':
			$dateFormat = "%a";
			break;
		default:
			$dateFormat = "%B %d, %Y at %I:%M %p";
			break;
	}
	return strftime($dateFormat, $unixdatetime);
}
 
/**
* Serial Number Generator
* @param int $no
* @return string
*/
function GenerateSerial($no=5, $id) {
    $chars 	= array(0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    $serial = '';
    $max 	= count($chars)-1;

    for ($i=0;$i<$no;$i++) {
		 $serial .= (!($i % 5) && $i ? '-' : '').$chars[rand(0, $max)];
	}

    return 'GRU'.$id.'-'.$serial;
}
