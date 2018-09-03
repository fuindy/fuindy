<?php

namespace Fuindy\Repositories\School\v1\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceSchoolSetting extends Model
{
    protected $connection = 'customer';

    protected $table = 'attendance_school_settings';

    protected $guarded = [''];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }
}
