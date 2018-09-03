<?php

namespace Fuindy\Repositories\RegistrationStudent\v1\Models;

use Fuindy\Repositories\Account\v1\Models\Customer;
use Fuindy\Repositories\Components\v1\Models\Department;
use Fuindy\Repositories\Components\v1\Models\Religion;
use Fuindy\Repositories\Components\v1\Models\StatusRegistration;
use Fuindy\Repositories\School\v1\Models\School;
use Illuminate\Database\Eloquent\Model;

class RegistrationStudent extends Model
{
    protected $connection = 'customer';

    protected $table = 'registration_students';

    public $incrementing = false;

    protected $guarded = [''];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function status()
    {
        return $this->belongsTo(StatusRegistration::class, 'status_registration_id');
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class, 'religion_id');
    }
}
