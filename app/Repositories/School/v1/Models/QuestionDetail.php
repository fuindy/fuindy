<?php

namespace App\Repositories\School\v1\Models;

use App\Repositories\Components\v1\Models\QuestionAnswer;
use Illuminate\Database\Eloquent\Model;

class QuestionDetail extends Model
{
    protected $table = "question_details";

    public $incrementing = false;

    protected $guarded = [''];

    public function question()
    {
        return $this->belongsTo(Question::class, "question_id");
    }

    public function answer()
    {
        return $this->belongsTo(QuestionAnswer::class, 'answer_true');
    }
}
