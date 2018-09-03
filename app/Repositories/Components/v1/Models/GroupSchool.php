<?php

namespace Fuindy\Repositories\Components\v1\Models;

use Illuminate\Database\Eloquent\Model;

class GroupSchool extends Model
{
    protected $connection = 'customer';

    protected $table = 'group_schools';

    protected $guarded = [''];
}
