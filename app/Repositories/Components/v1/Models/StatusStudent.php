<?php

namespace Fuindy\Repositories\Components\v1\Models;

use Illuminate\Database\Eloquent\Model;

class StatusStudent extends Model
{
    protected $connection = 'customer';

    protected $table = 'status_students';

    protected $guarded = [''];
}
