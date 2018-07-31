<?php

namespace App\Repositories\Student\v1\Models;

use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    protected $table = 'student_classes';

    public function group()
    {
        return $this->belongsTo(StudentClass::class, 'school_group_id');
    }
}
