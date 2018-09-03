<?php

namespace Fuindy\Repositories\Components\v1\Models;

use Illuminate\Database\Eloquent\Model;

class TypeQuestion extends Model
{
    protected $connection = 'customer';

    protected $table = "type_questions";

    protected $guarded = [''];
}
