<?php

namespace App\Repositories\Student\v1\Models;

use Illuminate\Database\Eloquent\Model;

class StudentQuestionTestDetail extends Model
{
    protected $table = "student_question_test_details";

    public $incrementing = false;

    protected $guarded = [''];

    public function question()
    {
        return $this->belongsTo(StudentQuestionTest::class, "question_test_id");
    }

}
