<?php

namespace App\Repositories\School\v1\Logics;

use App\Http\Requests\v1\School\AddSchoolRequest;
use Illuminate\Http\Request;

abstract class RegistrationStudentUseCase
{
    public static function registrationDate(Request $request)
    {
        return (new static)->handleRegistrationDate($request);
    }

    abstract public function handleRegistrationDate($request);

    public static function confirmRegistration(Request $request)
    {
        return (new static)->handleConfirmRegistration($request);
    }

    abstract public function handleConfirmRegistration($request);

    public static function acceptedStudent(Request $request)
    {
        return (new static)->handleAcceptedStudent($request);
    }

    abstract public function handleAcceptedStudent($request);

}