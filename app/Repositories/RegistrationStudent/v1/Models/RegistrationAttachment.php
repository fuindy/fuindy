<?php

namespace App\Repositories\RegistrationStudent\v1\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationAttachment extends Model
{
    protected $table = 'registration_attachments';

    public function registration()
    {
        return $this->belongsTo(RegistrationStudent::class, 'registration_student_id');
    }
}
