<?php

namespace Fuindy\Repositories\Components\v1\Models;

use Illuminate\Database\Eloquent\Model;

class GroupParticipantQuestionTest extends Model
{
    protected $connection = 'customer';

    protected $table = 'group_participant_question_tests';

    protected $guarded = [''];
}
