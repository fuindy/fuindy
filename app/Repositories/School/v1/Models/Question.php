<?php

namespace App\Repositories\School\v1\Models;

use App\Repositories\Components\v1\Models\Department;
use App\Repositories\Components\v1\Models\GroupQuestion;
use App\Repositories\Components\v1\Models\TypeQuestion;
use App\Repositories\Student\v1\Models\StudentClass;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    public $incrementing = false;

    protected $guarded = [''];

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

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function class()
    {
        return $this->belongsTo(StudentClass::class, 'class_id');
    }
}
