<?php

namespace App\Model\School;

use Illuminate\Database\Eloquent\Model;

class tbl_school extends Model
{
    protected $primaryKey = 'id_school';

    protected $table = 'tbl_schools';

    public function group()
    {
        return $this->belongsTo(tbl_school_group::class, 'id_school_group');
    }
}
