<?php

namespace Fuindy\Repositories\Student\v1\Models;

use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    protected $connection = 'customer';

    protected $table = 'student_classes';

    protected $guarded = [''];

    public function group()
    {
        return $this->belongsTo(StudentClass::class, 'school_group_id');
    }
}
