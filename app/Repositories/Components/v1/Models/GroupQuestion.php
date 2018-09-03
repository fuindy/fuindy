<?php

namespace Fuindy\Repositories\Components\v1\Models;

use Illuminate\Database\Eloquent\Model;

class GroupQuestion extends Model
{
    protected $connection = 'customer';

    protected $table = "group_questions";

    protected $guarded = [''];
}
