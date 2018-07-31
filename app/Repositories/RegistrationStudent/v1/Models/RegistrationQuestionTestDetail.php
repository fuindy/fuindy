<?php

namespace App\Repositories\RegistrationStudent\v1\Models;

use Illuminate\Database\Eloquent\Model;

class RegistrationQuestionTestDetail extends Model
{
    protected $table = "registration_question_test_details";

    public $incrementing = false;

    protected $guarded = [''];

    public function question()
    {
        return $this->belongsTo(RegistrationQuestionTest::class, "question_test_id");
    }

}
