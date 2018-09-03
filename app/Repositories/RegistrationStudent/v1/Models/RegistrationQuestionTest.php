<?php

namespace Fuindy\Repositories\RegistrationStudent\v1\Models;

use Fuindy\Repositories\Components\v1\Models\GroupParticipantQuestionTest;
use Fuindy\Repositories\Components\v1\Models\StatusQuestionTest;
use Fuindy\Repositories\School\v1\Models\Question;
use Fuindy\Repositories\School\v1\Models\School;
use Illuminate\Database\Eloquent\Model;

class RegistrationQuestionTest extends Model
{
    protected $connection = 'customer';

    protected $table = "registration_question_tests";

    public $incrementing = false;

    protected $guarded = [''];

    public function question()
    {
        return $this->belongsTo(Question::class, "question_id");
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function registration()
    {
        return $this->belongsTo(RegistrationStudent::class, 'registration_id');
    }

    public function groupParticipant()
    {
        return $this->belongsTo(GroupParticipantQuestionTest::class, 'group_participant_id');
    }

    public function answer()
    {
        return $this->hasMany(RegistrationQuestionTestDetail::class, 'question_test_id');
    }

    public function status()
    {
        return $this->belongsTo(StatusQuestionTest::class, 'status');
    }
}
