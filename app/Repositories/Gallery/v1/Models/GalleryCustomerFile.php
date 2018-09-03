<?php

namespace Fuindy\Repositories\Gallery\v1\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryCustomerFile extends Model
{
    protected $connection = 'customer';

    protected $table = 'gallery_customer_files';

    protected $guarded = [''];

    public function gallery()
    {
        return $this->belongsTo(GalleryCustomer::class, 'gallery_id');
    }
}
