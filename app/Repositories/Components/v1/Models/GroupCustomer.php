<?php

namespace Fuindy\Repositories\Components\v1\Models;

use Illuminate\Database\Eloquent\Model;

class GroupCustomer extends Model
{
    protected $connection = 'customer';

    protected $table = 'group_customers';

    protected $guarded = [''];
}
