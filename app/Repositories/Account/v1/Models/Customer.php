<?php

namespace App\Repositories\Account\v1\Models;

use App\Repositories\Components\v1\Models\GroupCustomer;
use App\Repositories\RegistrationStudent\v1\Models\RegistrationStudent;
use App\Repositories\Student\v1\Models\Student;
use App\Repositories\Teacher\v1\Models\Teacher;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    public $incrementing = false;

    protected $guarded = [''];

    public function group()
    {
        return $this->belongsTo(GroupCustomer::class, 'customer_group_id');
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'customer_id');
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'customer_id');
    }

    public function registration()
    {
        return $this->hasMany(RegistrationStudent::class, 'customer_id');
    }
}
