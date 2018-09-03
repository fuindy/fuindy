<?php

namespace Fuindy\Repositories\Teacher\v1\Logics;

use Fuindy\Http\Requests\v1\School\AddSchoolRequest;
use Illuminate\Http\Request;

abstract class QuestionUseCase
{
    public static function uploadQuestionStudent(Request $request)
    {
        return (new static)->handleUploadQuestionStudent($request);
    }

    abstract public function handleUploadQuestionStudent($request);

    public static function questionStudentStatus(Request $request)
    {
        return (new static)->handleQuestionStudentStatus($request);
    }

    abstract public function handleQuestionStudentStatus($request);

}