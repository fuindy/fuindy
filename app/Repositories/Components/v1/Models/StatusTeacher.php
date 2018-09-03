<?php

namespace Fuindy\Repositories\Components\v1\Models;

use Illuminate\Database\Eloquent\Model;

class StatusTeacher extends Model
{
    protected $connection = 'customer';

    protected $table = 'status_teachers';

    protected $guarded = [''];
}
