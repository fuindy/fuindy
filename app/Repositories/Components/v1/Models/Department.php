<?php

namespace Fuindy\Repositories\Components\v1\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $connection = 'customer';

    protected $table = 'departments';

    public $incrementing = false;

    protected $guarded = [''];

}
