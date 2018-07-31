<?php

namespace App\Repositories\School\v1\Models;

use App\Repositories\Account\v1\Models\User;
use App\Repositories\Components\v1\Models\GroupSchool;
use App\Repositories\RegistrationStudent\v1\Models\RegistrationDate;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'schools';

    public $incrementing = false;

    protected $guarded = [''];

    public function group()
    {
        return $this->belongsTo(GroupSchool::class, 'school_group_id');
    }

    public function registerDate()
    {
        return $this->hasOne(RegistrationDate::class, 'school_id');
    }
}
