<?php

namespace Fuindy\Repositories\Components\v1\Models;

use Illuminate\Database\Eloquent\Model;

class GroupNotification extends Model
{
    protected $connection = 'customer';

    protected $table = 'group_notifications';

    protected $guarded = [''];
}
