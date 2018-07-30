<?php

namespace App\Repositories\RegistrationStudent\v1\Logics;

use Illuminate\Http\Request;

abstract class QuestionRegistrationUseCase
{
    public static function checkAnswerRegistration(Request $request)
    {
        return (new static)->handleCheckAnswerRegistration($request);
    }

    abstract public function handleCheckAnswerRegistration($request);
}