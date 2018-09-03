<?php

namespace Fuindy\Repositories\Student\v1\Models;

use Fuindy\Repositories\Account\v1\Models\Customer;
use Fuindy\Repositories\Components\v1\Models\Department;
use Fuindy\Repositories\Components\v1\Models\GroupOrganisationClass;
use Fuindy\Repositories\Components\v1\Models\GroupOrganisationSchool;
use Fuindy\Repositories\Components\v1\Models\Religion;
use Fuindy\Repositories\Components\v1\Models\StatusStudent;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $connection = 'customer';

    protected $table = 'students';

    public $incrementing = false;

    protected $guarded = [''];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function class()
    {
        return $this->belongsTo(StudentClass::class, 'student_class_id');
    }

    public function status()
    {
        return $this->belongsTo(StatusStudent::class, 'status_student_id');
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class, 'religion_id');
    }

    public function groupOrganisationClass()
    {
        return $this->belongsTo(GroupOrganisationClass::class, 'group_organisation_class_id');
    }

    public function groupOrganisationSchool()
    {
        return $this->belongsTo(GroupOrganisationSchool::class, 'group_organisation_school_id');
    }
}
