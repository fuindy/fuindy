<?php

namespace App\Model\Customer;

use Illuminate\Database\Eloquent\Model;

class tbl_customer extends Model
{
    protected $primaryKey = 'id_customer';

    protected $table = 'tbl_customers';

    public function group()
    {
        return $this->belongsTo(tbl_customer_group::class, 'id_customer_group');
    }

}
