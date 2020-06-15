<?php

namespace App\Models;

use App\User;
use App\Enhancers\AppHelper;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faq';

    protected $fillable = [
        'creator', 'question', 'answer', 'category'
    ];

    /**
     * Get creator full name
     *
     * @param string $textStyle
     * @return string
     */
    public function getCreatorFullName($textStyle='strtoupper') : string
    {
            $result = User::where('id', $this->creator)->first();
            return textTransformer($result->getFullName(), $textStyle);
    }

    public function getAnswer($textStyle='strtoupper') : string
    {
        return textTransformer(shortenContent($this->answer ?? '...', 30), $textStyle);
    }

    public function getCategory($textStyle='strtoupper') : string
    {
        return textTransformer(AppHelper::$faq_categories[$this->category] ?? "", $textStyle);
    }
}
