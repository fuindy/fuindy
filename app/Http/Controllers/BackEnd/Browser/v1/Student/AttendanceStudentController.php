<?php

namespace App\Http\Controllers\BackEnd\Browser\v1\Student;

use App\Repositories\Student\v1\Models\AttendanceStudent;
use App\Traits\v1\Globals\GlobalComponentCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AttendanceStudentController extends Controller
{
    public function CheckAttend(Request $request)
    {
        $chairmanClass = isset(Auth::user()->customer->student) ?
            Auth::user()->customer->student->group_organisation_class_id :
            null;

        if ($chairmanClass != null || $chairmanClass == GlobalComponentCode::$GROUP_ORGANISATION_CLASS['CHAIRMAN']) {

//            $attend = AttendanceStudent::
        }
    }
}
