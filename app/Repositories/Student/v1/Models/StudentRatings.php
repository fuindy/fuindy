<?php

namespace App\Repositories\Student\v1\Models;

use App\Repositories\Account\v1\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class StudentRatings extends Model
{
    protected $table = 'student_ratings';

    public function class()
    {
        return $this->belongsTo(StudentClass::class, 'student_class_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
