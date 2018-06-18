<?php

namespace App\Repositories\RegistrationStudent\v1\Models;

use App\Repositories\School\v1\Models\School;
use Illuminate\Database\Eloquent\Model;

class RegistrationDate extends Model
{
    protected $table = 'registration_dates';

    protected $guarded = [''];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }
}
