<?php

namespace App\Repositories\Components\v1\Models;

use App\Repositories\RegistrationStudent\v1\Models\RegistrationStudent;
use App\Repositories\School\v1\Models\Question;
use App\Repositories\Student\v1\Models\Student;
use Illuminate\Database\Eloquent\Model;

class HistoryQuestion extends Model
{
    protected $table = 'history_questions';

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
