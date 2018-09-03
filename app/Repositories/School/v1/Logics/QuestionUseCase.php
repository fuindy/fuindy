<?php

namespace Fuindy\Repositories\School\v1\Logics;

use Fuindy\Http\Requests\v1\School\AddSchoolRequest;
use Illuminate\Http\Request;

abstract class QuestionUseCase
{
    public static function addQuestion(Request $request)
    {
        return (new static)->handleAddQuestion($request);
    }

    abstract public function handleAddQuestion($request);

    public static function uploadQuestionRegistration(Request $request)
    {
        return (new static)->handleUploadQuestionRegistration($request);
    }

    abstract public function handleUploadQuestionRegistration($request);

    public static function questionRegistrationStatus(Request $request)
    {
        return (new static)->handleQuestionRegistrationStatus($request);
    }

    abstract public function handleQuestionRegistrationStatus($request);

}