<?php

namespace Fuindy\Repositories\School\v1\Models;

use Fuindy\Repositories\Account\v1\Models\User;
use Fuindy\Repositories\Components\v1\Models\GroupSchool;
use Fuindy\Repositories\RegistrationStudent\v1\Models\RegistrationDate;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $connection = 'customer';

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
