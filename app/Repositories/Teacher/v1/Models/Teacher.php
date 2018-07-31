<?php

namespace App\Repositories\Teacher\v1\Models;

use App\Repositories\Components\v1\Models\Religion;
use App\Repositories\Components\v1\Models\StatusTeacher;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';

    public function status()
    {
        return $this->belongsTo(StatusTeacher::class, 'status_teacher_id');
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class, 'religion_id');
    }
}
