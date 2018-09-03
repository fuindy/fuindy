<?php

namespace Fuindy\Repositories\Student\v1\Models;

use Fuindy\Repositories\Components\v1\Models\Department;
use Fuindy\Repositories\Components\v1\Models\GroupParticipantQuestionTest;
use Fuindy\Repositories\School\v1\Models\Question;
use Fuindy\Repositories\School\v1\Models\School;
use Illuminate\Database\Eloquent\Model;

class StudentQuestionTest extends Model
{
    protected $connection = 'customer';

    protected $table = 'student_question_tests';

    public $incrementing = false;

    protected $guarded = [''];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function class()
    {
        return $this->belongsTo(StudentClass::class, 'class_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function groupParticipant()
    {
        return $this->belongsTo(GroupParticipantQuestionTest::class, 'group_participant_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function answer()
    {
        return $this->hasMany(StudentQuestionTestDetail::class, 'question_test_id');
    }
}
