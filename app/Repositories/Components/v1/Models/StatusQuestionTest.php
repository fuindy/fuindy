<?php

namespace Fuindy\Repositories\Components\v1\Models;

use Illuminate\Database\Eloquent\Model;

class StatusQuestionTest extends Model
{
    protected $connection = 'customer';

    protected $table = 'status_question_tests';

    protected $guarded = [''];
}
