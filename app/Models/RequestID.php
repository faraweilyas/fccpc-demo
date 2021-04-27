<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestID extends Model
{
    protected $table = 'id_request';

    protected $guarded = [];

    /**
     * Get submitted at
     *
     * @param $string $format
     * @return String
     */
    public function getSubmittedAt(string $format='customdate') : string
    {
        return !empty($this->created_at) ? datetimeToText($this->created_at, $format) : "";
    }

    /**
     * Get category
     *
     * @param String $textStyle
     * @return String
     */
    public function getCategory($textStyle=NULL) : string
    {
        return \AppHelper::value('case_categories', $this->category, $textStyle) ?? "";
    }

    /**
     * Get category text
     *
     * @param String $textStyle
     * @return String
     */
    public function getCategoryText($textStyle=NULL) : string
    {
        return \AppHelper::value('case_categories_text', $this->category, $textStyle) ?? "";
    }

    /**
     * Get category html
     *
     * @param String $textStyle
     * @return String
     */
    public function getCategoryHtml($textStyle=NULL) : string
    {
        $category       = $this->getCategory($textStyle);
        $categoryHtml   = \AppHelper::value('case_categories_html', $this->category, NULL) ?? "";
        return "<span class='label label-lg font-weight-bold label-inline label-light-{$categoryHtml}'>{$category}</span>";
    }

    /**
     * Get case type
     *
     * @param String $textStyle
     * @return String
     */
    public function getType($textStyle='ucfirst') : string
    {
        return \AppHelper::value('case_types', $this->type, $textStyle) ?? "";
    }

    /**
     * Get type html
     *
     * @param String $textStyle
     * @return String
     */
    public function getTypeHtml($textStyle='ucfirst') : string
    {
        $type       = $this->getType($textStyle);
        $typeHtml   = \AppHelper::value('case_types_html', $this->type, NULL) ?? "";
        return "<span class='label label-{$typeHtml} label-dot mr-2'></span>
                <span class='font-weight-bold text-{$typeHtml}'>{$type}</span>";
    }

    /**
     * Get case parties
     *
     * @param bool $collect
     * @return Mixed
     */
    public function getCaseParties(bool $collect=true)
    {
        $parties = (empty($this->parties)) ? [] : explode(':', $this->parties);
        return ($collect) ? collect($parties) : $parties;
    }

    /**
     * Get case parties text
     *
     * @return Array
     */
    public function getCasePartiesText()
    {
        return implode(', ', $this->getCaseParties(false));
    }

    /**
     * Generate case parties badge
     *
     * String $extraStyles
     * @return integer
     */
    public function generateCasePartiesBadge($extraStyles='mr_10') : string
    {
        $styles = ['success', 'danger', 'warning', 'info', 'primary'];
        return $this->getCaseParties()->map(function($party) use ($styles, $extraStyles)
        {
            $style = $styles[rand(0, count($styles) - 1)];
            return "<span class='label label-lg font-weight-bold label-light-{$style} text-dark label-inline {$extraStyles}'>{$party}</span>";
        })->join(" ");
    }
}
