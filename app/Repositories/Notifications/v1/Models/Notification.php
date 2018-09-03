<?php

namespace Fuindy\Repositories\Notifications\v1\Models;

use Fuindy\Repositories\Components\v1\Models\GroupNotification;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $connection = 'customer';

    protected $table = 'notifications';

    protected $guarded = [''];

    public function group()
    {
        return $this->belongsTo(GroupNotification::class, 'group_id');
    }
}
