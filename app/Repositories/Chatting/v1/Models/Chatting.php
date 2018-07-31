<?php

namespace App\Repositories\Chatting\v1\Models;

use Illuminate\Database\Eloquent\Model;

class Chatting extends Model
{
    protected $table = 'chattings';

    public function friend()
    {
        return $this->belongsTo(ChattingFriend::class, 'friend_id');
    }

    public function group()
    {
        return $this->belongsTo(ChattingGroup::class, 'friend_id');
    }
}
