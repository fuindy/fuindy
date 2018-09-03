<?php

namespace Fuindy\Repositories\RegistrationStudent\v1\Models;

use Fuindy\Repositories\School\v1\Models\School;
use Illuminate\Database\Eloquent\Model;

class RegistrationDate extends Model
{
    protected $connection = 'customer';

    protected $table = 'registration_dates';

    protected $guarded = [''];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }
}
