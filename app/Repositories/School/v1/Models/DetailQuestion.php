<?php

namespace App\Repositories\School\v1\Models;

use Illuminate\Database\Eloquent\Model;

class DetailQuestion extends Model
{
    protected $table = "detail_questions";

    public function question()
    {
        return $this->belongsTo(Question::class, "question_id");
    }
}
