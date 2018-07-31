<?php

namespace App\Repositories\Account\v1\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryCustomer extends Model
{
    protected $table = 'gallery_customers';

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
