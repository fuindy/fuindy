<?php

namespace Fuindy\Repositories\Student\v1\Models;

use Fuindy\Repositories\School\v1\Models\School;
use Illuminate\Database\Eloquent\Model;

class AttendanceStudent extends Model
{
    protected $connection = 'customer';

    protected $table = 'attendance_students';

    protected $guarded = [''];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function studentClass()
    {
        return $this->belongsTo(StudentClass::class, 'student_class_id');
    }
}
