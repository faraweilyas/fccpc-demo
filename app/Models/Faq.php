<?php

namespace App\Models;

use App\User;
use App\Enhancers\AppHelper;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faq';

    protected $fillable = [
        'creator', 'slug', 'question', 'answer', 'category'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'creator', 'id');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'question_id', 'id');
    }

    public function countFeedbacks() : int
    {
        return $this->feedbacks()->count();
    }

    public function countPositiveFeedbacks() : int
    {
        return $this->feedbacks()->where('feedback', 1)->count();
    }

    public function countNegativeFeedbacks() : int
    {
        return $this->feedbacks()->where('feedback', 0)->count();
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

    /**
     * Get category
     *
     * @param string $textStyle
     * @return string
     */
    public function getCategory($textStyle='strtoupper') : string
    {
        return textTransformer(AppHelper::$faq_categories[$this->category] ?? "", $textStyle);
    }
}
