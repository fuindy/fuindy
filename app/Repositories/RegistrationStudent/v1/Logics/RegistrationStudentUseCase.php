<?php

namespace App\Repositories\RegistrationStudent\v1\Logics;

use App\Http\Requests\v1\Student\RegistrationStudentRequest;
use Illuminate\Http\Request;

abstract class RegistrationStudentUseCase
{
    public static function getSchool()
    {
        return (new static)->handleGetSchool();
    }

    abstract public function handleGetSchool();

    public static function registration(RegistrationStudentRequest $request)
    {
        return (new static)->handleRegistration($request);
    }

    abstract public function handleRegistration($request);

    public static function registrationAttachment(Request $request)
    {
        return (new static)->handleRegistrationAttachment($request);
    }

    abstract public function handleRegistrationAttachment($request);

}