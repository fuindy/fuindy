<?php

namespace Fuindy\Repositories\Chatting\v1\Models;

use Illuminate\Database\Eloquent\Model;

class ChattingGroup extends Model
{
    protected $connection = 'chatting';

    protected $table = 'access_groups';
}
