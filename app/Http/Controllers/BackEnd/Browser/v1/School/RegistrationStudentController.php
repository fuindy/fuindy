<?php

namespace App\Http\Controllers\BackEnd\Browser\v1\School;

use App\Repositories\School\v1\Logics\RegistrationStudentLogic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
