<?php

namespace App\Model\Customer\Student;

use App\Model\Customer\tbl_customer;
use App\Model\School\tbl_department;
use Illuminate\Database\Eloquent\Model;

class tbl_student extends Model
{
    protected $primaryKey = 'id_student';

    protected $table = 'tbl_students';

    public function customer()
    {
        return $this->belongsTo(tbl_customer::class, 'id_customer');
    }

    public function department()
    {
        return $this->belongsTo(tbl_department::class, 'id_department');
    }

    public function class()
    {
        return $this->belongsTo(tbl_student_class::class, 'id_student_class');
    }

    public function status()
    {
        return $this->belongsTo(tbl_status_student::class, 'id_status_student');
    }
}
