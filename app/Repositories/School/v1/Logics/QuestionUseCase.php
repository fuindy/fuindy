<?php

namespace App\Repositories\School\v1\Logics;

use App\Http\Requests\v1\School\AddSchoolRequest;
use Illuminate\Http\Request;

abstract class QuestionUseCase
{
    public static function addQuestion(Request $request)
    {
        return (new static)->handleAddQuestion($request);
    }

    abstract public function handleAddQuestion($request);

}