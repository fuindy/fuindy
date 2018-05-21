<?php

namespace App\Model\Customer\Teacher;

use Illuminate\Database\Eloquent\Model;

class tbl_teacher extends Model
{
    protected $primaryKey = 'id_teacher';

    protected $table = 'tbl_teachers';

    public function status()
    {
        return $this->belongsTo(tbl_status_teacher::class, 'id_status_teacher');
    }
}
