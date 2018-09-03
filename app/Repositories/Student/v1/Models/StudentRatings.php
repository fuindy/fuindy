<?php

namespace Fuindy\Repositories\Student\v1\Models;

use Fuindy\Repositories\Account\v1\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class StudentRatings extends Model
{
    protected $connection = 'customer';

    protected $table = 'student_ratings';

    protected $guarded = [''];

    public function class()
    {
        return $this->belongsTo(StudentClass::class, 'student_class_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
