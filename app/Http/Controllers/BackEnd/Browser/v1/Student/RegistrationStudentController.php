<?php

namespace App\Http\Controllers\BackEnd\Browser\v1\Student;

use App\Http\Controllers\BackEnd\Browser\v1\Traits\Config;
use App\Http\Requests\v1\Student\RegistrationStudentRequest;
use App\Repositories\RegistrationStudent\v1\Logics\RegistrationStudentLogic;
use App\Repositories\RegistrationStudent\v1\Models\RegistrationAttachment;
use App\Repositories\RegistrationStudent\v1\Models\RegistrationStudent;
use App\Repositories\Student\v1\Models\Student;
use App\Traits\v1\Globals\GlobalUtils;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegistrationStudentController extends Controller
{
    use GlobalUtils;

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
