<?php

namespace App\Model\Customer;

use Illuminate\Database\Eloquent\Model;

class tbl_gallery_customer extends Model
{
    protected $primaryKey = 'id_gallery';

    protected $table = 'tbl_gallery_customers';

    public function customer()
    {
        return $this->belongsTo(tbl_customer::class, 'id_customer');
    }
}
