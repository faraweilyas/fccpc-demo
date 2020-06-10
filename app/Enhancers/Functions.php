<?php

/**
 * Prevents file caching for javascript or css files by adding last modified timestamp.
 *
 * @param string $file
 * @return string
 */
function preventFileCaching(string $file='') : string
{
    $file       = "/".ltrim($file, "/");
    $filePath   = public_path().$file;
    if (!file_exists($filePath))
        return $file;

    $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
    if (in_array($fileExtension, ['css', 'js'])):
        $lastTimeModified   = filemtime($filePath);
        $file               .= "?mod={$lastTimeModified}";
    endif;
    return $file;
}

/**
 * Overrides default asset function to prevent file caching.
 *
 * @param string $asset
 * @return string
 */
function pc_asset(string $asset=NULL) : string
{
    return asset(preventFileCaching($asset));
}

/**
 * Configure Page Headers
 *
 * @param string title
 * @param string description
 * @return \stdClass
 */
function details($title, $description) : \stdClass
{
    return (object) [
        'title'         => $title,
        'description'   => $description,
    ];
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
 *
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
 *
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
 *
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
 *
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
 *
 * @param string $dateTime
 * @param string $format
 * @return string
 */
function reFormatDate(string $date=NULL, string $format="d-m-Y") : string
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
 *
 * @return string
 */
function getRandomColor() : string
{
	$colors = ['#0071c5', '#40E0D0', '#008000', '#FFD700', '#FF8C00', '#FF0000'];
	return $colors[rand(0, count($colors) - 1)];
}

/**
 * Datetiime converter
 *
 * @param string $dateTime
 * @param string $format
 * @return string
 */
function datetimeToText(string $datetime, string $format="fulldate") : string
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
 * Getter for application author.
 * @return string
 */
function author() : string
{
	if (defined('AUTHORS')):
		return is_array(AUTHORS) ? implode(", ", AUTHORS) : AUTHORS;
	else:
		return "Author is not defined";
	endif;
}

/**
 * Getter for agency link.
 *
 * @return string
 */
function agencyLink() : string
{
	return defined('AGENCY_LINK') ? AGENCY_LINK : "Agency link is not defined";
}

/**
 * Generate serial number with length 13
 *
 * @param callable $callable
 * @param string $preText
 * @param string $postText
 * @return string
 */
function generate(callable $callable, string $preText=NULL, string $postText=NULL) : string
{
	return strtoupper($preText.$callable(uniqid()).$postText);
}

/**
 * Format application type
 *
 * @param string $type
 * @return string
 */
function formatApplicationType(string $type) : string
{
	$case = "";
	switch($type)
	{
		case 'regular':
			$case = ucfirst($type);
			break;
		case 'ffm':
			$case = strtoupper($type);
			break;
		case 'ffm-expediated':
			$case = 'FFM Expediated';
			break;
		default:
			$case = '';
			break;
	}
	return $case;
}

/**
 * Format enquiry type
 *
 * @param string $type
 * @return string
 */
function formatEnquiryType(string $type) : string
{
    $enquiry = "";
    switch($type)
    {
        case 'gen':
            $enquiry = \App\Enhancers\AppHelper::$enquiry_types[strtoupper($type)];
            break;
        case 'pre':
            $enquiry = \App\Enhancers\AppHelper::$enquiry_types[strtoupper($type)];
            break;
        default:
            $enquiry = '';
            break;
    }
    return $enquiry;
}

/**
 * Format case type
 *
 * @param string $type
 * @return string
 */
function formatCaseType(string $type) : string
{
	$case = "";
	switch($type)
	{
		case 'hold':
			$case = 'Cases On Hold';
			break;
		case 'requests':
			$case = 'Requests Log';
			break;
		default:
			$case = ucfirst($type).' '.'cases';
			break;
	}
	return $case;
}

/**
 * Generate serial number
 *
 * @return string
 */
function generateSerialNumber() : string
{
	return generate(function($serialNumber)
	{
		return substr($serialNumber, 7, 13);
	}, "CHCO", "SN");
}

/**
 * Generate applicant ID
 *
 * @return string
 */
function generateApplicantID() : string
{
	$monthDay = date('md');
	return generate(function($serialNumber)
	{
		return substr($serialNumber, 7, 13);
	}, "APP{$monthDay}");
}

/**
 * Generate Reference Number
 *
 * @param string $id
 * @return string
 */
function generateRefNo($id) : string
{
	$random_number_array1 = range(0, 100);
	$random_number_array2 = range(0, 100);
	$name 				  = "abcdefghijklmnopqrstuvwxy";
	shuffle($random_number_array1);
	shuffle($random_number_array2);
	str_shuffle($name);
	$random_number_array1 = array_slice($random_number_array1 ,0,10);
	$random_number_array2 = array_slice($random_number_array2 ,0,10);

	return "FCCPC/".substr(strtoupper(str_shuffle($name)), -2)."/M&A/".substr($random_number_array1[0].$random_number_array1[1], -4)."/".substr($random_number_array1[2].$random_number_array1[3], -2).substr($id, -3);
}

/**
 * Get User Account Type
 *
 * @return string
 */
function getAccountType() : string
{
	if(Auth::check()):
		return strtolower(Auth::user()->accountType);
	else:
		return 'guest';
	endif;
}

/**
 * Text transformer
 *
 * @param string $value
 * @param string $textStyle
 * @return string
 */
function textTransformer(string $value=NULL, string $textStyle='strtoupper') : string
{
    return (is_callable($textStyle)) ? $textStyle($value) : $value;
}
