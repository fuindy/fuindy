<?php

namespace App\Repositories\Components\v1\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    public $incrementing = false;

    protected $guarded = [''];

}
