<?php

namespace Fuindy\Repositories\Components\v1\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    protected $connection = 'customer';

    protected $table = 'question_answers';

    protected $guarded = [''];
}
