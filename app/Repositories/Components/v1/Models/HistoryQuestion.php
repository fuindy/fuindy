<?php

namespace Fuindy\Repositories\Components\v1\Models;

use Fuindy\Repositories\RegistrationStudent\v1\Models\RegistrationStudent;
use Fuindy\Repositories\School\v1\Models\Question;
use Fuindy\Repositories\Student\v1\Models\Student;
use Illuminate\Database\Eloquent\Model;

class HistoryQuestion extends Model
{
    protected $connection = 'customer';

    protected $table = 'history_questions';

    protected $guarded = [''];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'participant_id');
    }

    public function registration()
    {
        return $this->belongsTo(RegistrationStudent::class, 'participant_id');
    }
}
