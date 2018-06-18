<?php

namespace App\Repositories\RegistrationStudent\v1\Models;

use App\Repositories\Components\v1\Models\Department;
use App\Repositories\Components\v1\Models\Religion;
use App\Repositories\Components\v1\Models\StatusRegistration;
use App\Repositories\School\v1\Models\School;
use Illuminate\Database\Eloquent\Model;

class RegistrationStudent extends Model
{
    protected $table = 'registration_students';

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
