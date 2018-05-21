<?php

namespace App\Model\Customer\Student;

use App\Model\Customer\tbl_customer;
use Illuminate\Database\Eloquent\Model;

class tbl_student_ratings extends Model
{
    protected $primaryKey = 'id_student_rating';

    protected $table = 'tbl_student_ratings';

    public function class()
    {
        return $this->belongsTo(tbl_student_class::class, 'id_student_class');
    }

    public function customer()
    {
        return $this->belongsTo(tbl_customer::class, 'id_customer');
    }
}
