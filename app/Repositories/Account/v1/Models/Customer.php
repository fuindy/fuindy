<?php

namespace Fuindy\Repositories\Account\v1\Models;

use Fuindy\Repositories\Components\v1\Models\GroupCustomer;
use Fuindy\Repositories\RegistrationStudent\v1\Models\RegistrationStudent;
use Fuindy\Repositories\Student\v1\Models\Student;
use Fuindy\Repositories\Teacher\v1\Models\Teacher;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $connection = 'customer';

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
