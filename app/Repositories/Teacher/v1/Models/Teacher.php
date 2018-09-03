<?php

namespace Fuindy\Repositories\Teacher\v1\Models;

use Fuindy\Repositories\Components\v1\Models\Religion;
use Fuindy\Repositories\Components\v1\Models\StatusTeacher;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $connection = 'customer';

    protected $table = 'teachers';

    protected $guarded = [''];

    public function status()
    {
        return $this->belongsTo(StatusTeacher::class, 'status_teacher_id');
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class, 'religion_id');
    }
}
