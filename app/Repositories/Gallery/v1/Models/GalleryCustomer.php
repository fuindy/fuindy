<?php

namespace Fuindy\Repositories\Gallery\v1\Models;

use Fuindy\Repositories\Account\v1\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class GalleryCustomer extends Model
{
    protected $connection = 'customer';

    protected $table = 'gallery_customers';

    protected $guarded = [''];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
