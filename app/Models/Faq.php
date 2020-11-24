<?php

namespace App\Models;

use App\Models\User;
use App\Enhancers\AppHelper;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function countFeedbacks() : int
    {
        return $this->feedbacks()->count();
    }

    public function countPositiveFeedbacks() : int
    {
        return $this->feedbacks()->where('feedback', 'yes')->count();
    }

    public function countNegativeFeedbacks() : int
    {
        return $this->feedbacks()->where('feedback', 'no')->count();
    }

    public function path()
    {
        return route('home.faqs.faq', ['category' => $this->category, 'slug' => $this->slug]);
    }

    /**
     * Get creator
     *
     * @param string $textStyle
     * @return string
     */
    public function getCreator($textStyle='strtoupper') : string
    {
        return textTransformer($this->user->getFullName(), $textStyle);
    }

    /**
     * Get date created
     *
     * @param string $format
     * @return string
     */
    public function getCreatedAt(string $format='customdate') : string
    {
        return !empty($this->created_at) ? datetimeToText($this->created_at, $format) : "";
    }

     /**
     * Get Question
     *
     * @param int $length
     * @param mixed $textStyle
     * @return string
     */
    public function getQuestion(int $length=30, $textStyle=NULL) : string
    {
        return textTransformer(shortenContent($this->question, $length), $textStyle);
    }

    /**
     * Get answer
     *
     * @param int $length
     * @param mixed $textStyle
     * @return string
     */
    public function getAnswer(int $length=30, $textStyle=NULL) : string
    {
        return textTransformer(shortenContent($this->answer, $length), $textStyle);
    }

    public function getCategory($textStyle='ucfirst') : string
    {
        return \AppHelper::value('faq_categories', $this->category, $textStyle) ?? "";
    }

    /**
     * Get category
     *
     * @param string $textStyle
     * @return string
     */
    public function getCategoryHtml($textStyle='strtoupper') : string
    {
        $category       = $this->getCategory();
        $categoryHtml   = \AppHelper::value('faq_categories_html', $this->category, NULL) ?? "";
        return "<span class='label label-lg font-weight-bold label-light-{$categoryHtml} text-dark label-inline'>
                                            <b>{$category}</b>
                                        </span>";
        // return textTransformer(\AppHelper::value('faq_categories', $this->category) ?? "", $textStyle);
    }
}
