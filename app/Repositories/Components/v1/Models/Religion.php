<?php

namespace Fuindy\Repositories\Components\v1\Models;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    protected $connection = 'customer';

    protected $table = 'religions';

    protected $guarded = [''];
}
