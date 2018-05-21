<?php

namespace App\Model\School;

use Illuminate\Database\Eloquent\Model;

class tbl_department extends Model
{
    protected $primaryKey = 'id_department';

    protected $table = 'tbl_departments';

    public function school()
    {
        return $this->belongsTo(tbl_school::class, 'id_school');
    }
}
