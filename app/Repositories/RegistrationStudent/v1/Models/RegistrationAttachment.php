<?php

namespace Fuindy\Repositories\RegistrationStudent\v1\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationAttachment extends Model
{
    protected $connection = 'customer';

    protected $table = 'registration_attachments';

    protected $guarded = [''];

    public function registration()
    {
        return $this->belongsTo(RegistrationStudent::class, 'registration_student_id');
    }
}
