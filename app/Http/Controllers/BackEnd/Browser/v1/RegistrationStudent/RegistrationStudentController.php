<?php

namespace App\Http\Controllers\BackEnd\Browser\v1\RegistrationStudent;

use App\Http\Requests\v1\Student\RegistrationStudentRequest;
use App\Repositories\RegistrationStudent\v1\Logics\RegistrationStudentLogic;
use App\Traits\v1\Globals\GlobalUtils;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistrationStudentController extends Controller
{
    use GlobalUtils;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getSchool()
    {
        return RegistrationStudentLogic::getSchool();
    }

    public function registrationStudent(RegistrationStudentRequest $request)
    {
        return RegistrationStudentLogic::registration($request);
    }

    public function registrationAttachment(Request $request)
    {
        return RegistrationStudentLogic::registrationAttachment($request);
    }
}
