<?php

namespace App\Repositories\Notifications\v1\Models;

use App\Repositories\Components\v1\Models\GroupNotification;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    public function group()
    {
        return $this->belongsTo(GroupNotification::class, 'group_id');
    }
}
