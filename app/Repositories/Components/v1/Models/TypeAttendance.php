<?php

namespace Fuindy\Repositories\Components\v1\Models;

use Illuminate\Database\Eloquent\Model;

class TypeAttendance extends Model
{
    protected $connection = 'customer';

    protected $table = 'type_attendances';

    protected $guarded = [''];
}
