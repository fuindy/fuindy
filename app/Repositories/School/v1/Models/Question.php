<?php

namespace App\Repositories\School\v1\Models;

use App\Repositories\Components\v1\Models\GroupQuestion;
use App\Repositories\Components\v1\Models\TypeQuestion;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    public function group()
    {
        return $this->belongsTo(GroupQuestion::class, 'group_question_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function type()
    {
        return $this->belongsTo(TypeQuestion::class, 'type_question_id');
    }
}
