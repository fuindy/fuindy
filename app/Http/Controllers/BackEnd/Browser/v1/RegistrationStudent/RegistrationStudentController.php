<?php

namespace Fuindy\Http\Controllers\BackEnd\Browser\v1\RegistrationStudent;

use Fuindy\Http\Requests\v1\Student\RegistrationStudentRequest;
use Fuindy\Repositories\RegistrationStudent\v1\Logics\RegistrationStudentLogic;
use Fuindy\Traits\v1\Globals\GlobalUtils;
use Illuminate\Http\Request;
use Fuindy\Http\Controllers\Controller;

class RegistrationStudentController extends Controller
{
    use GlobalUtils;

    public function __construct()
    {
//        $this->middleware('auth');
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
