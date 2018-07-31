<?php

namespace App\Repositories\Student\v1\Models;

use App\Repositories\School\v1\Models\School;
use Illuminate\Database\Eloquent\Model;

class AttendanceStudent extends Model
{
    protected $table = 'attendance_students';

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
