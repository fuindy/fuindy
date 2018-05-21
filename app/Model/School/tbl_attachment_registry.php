<?php

namespace App\Model\School;

use Illuminate\Database\Eloquent\Model;

class tbl_attachment_registry extends Model
{
    protected $primaryKey = 'id_attachment';

    protected $table = 'tbl_attachment_registries';

    public function registration()
    {
        return $this->belongsTo(tbl_registration_student::class, 'id_registration_student');
    }
}
