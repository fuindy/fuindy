<?php

namespace Fuindy\Http\Controllers\BackEnd\Browser\v1\School;

use Fuindy\Repositories\School\v1\Logics\RegistrationStudentLogic;
use Illuminate\Http\Request;
use Fuindy\Http\Controllers\Controller;

class RegistrationStudentController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth.school');
    }

    public function registrationDate(Request $request)
    {
        return RegistrationStudentLogic::registrationDate($request);
    }

    public function confirmRegistration(Request $request)
    {
        return RegistrationStudentLogic::confirmRegistration($request);
    }

    public function acceptedStudent(Request $request)
    {
        return RegistrationStudentLogic::acceptedStudent($request);
    }

}
