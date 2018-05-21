<?php

namespace App\Model\School;

use Illuminate\Database\Eloquent\Model;

class tbl_registration_student extends Model
{
    protected $primaryKey = 'id_registration_student';

    protected $table = 'tbl_registration_students';

    public function school()
    {
        return $this->belongsTo(tbl_school::class, 'id_school');
    }

    public function department()
    {
        return $this->belongsTo(tbl_department::class, 'id_department');
    }

    public function status()
    {
        return $this->belongsTo(tbl_status_registration::class, 'id_status_registration');
    }

}
