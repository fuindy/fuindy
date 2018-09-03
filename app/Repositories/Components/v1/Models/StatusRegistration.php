<?php

namespace Fuindy\Repositories\Components\v1\Models;

use Illuminate\Database\Eloquent\Model;

class StatusRegistration extends Model
{
    protected $connection = 'customer';

    protected $table = 'status_registrations';

    protected $guarded = [''];
}
