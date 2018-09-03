<?php

namespace Fuindy\Repositories\Components\v1\Models;

use Illuminate\Database\Eloquent\Model;

class StatusActive extends Model
{
    protected $connection = 'customer';

    protected $table = 'status_actives';

    protected $guarded = [''];
}
