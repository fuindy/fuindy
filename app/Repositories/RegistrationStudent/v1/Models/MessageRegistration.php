<?php

namespace App\Repositories\RegistrationStudent\v1\Models;

use App\Repositories\School\v1\Models\School;
use Illuminate\Database\Eloquent\Model;

class MessageRegistration extends Model
{
    protected $table = 'message_registrations';

    public $incrementing = false;

    protected $guarded = [''];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function registration()
    {
        return $this->belongsTo(RegistrationStudent::class, 'registration_student_id');
    }
}
