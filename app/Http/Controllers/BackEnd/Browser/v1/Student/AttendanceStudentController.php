<?php

namespace Fuindy\Http\Controllers\BackEnd\Browser\v1\Student;

use Fuindy\Repositories\Student\v1\Jobs\AttendanceStudentProcess;
use Fuindy\Repositories\Student\v1\Logics\AttendanceStudentLogic;
use Fuindy\Repositories\Student\v1\Models\AttendanceStudent;
use Fuindy\Traits\v1\Globals\GlobalComponentCode;
use Illuminate\Http\Request;
use Fuindy\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AttendanceStudentController extends Controller
{
    public function createAttendance(Request $request)
    {
        $chairmanClass = isset(Auth::user()->customer->student) ?
            Auth::user()->customer->student->group_organisation_class_id :
            null;

        if ($chairmanClass != null || $chairmanClass == GlobalComponentCode::$GROUP_ORGANISATION_CLASS['CHAIRMAN']) {

            return AttendanceStudentLogic::createAttendance($request);
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'Not access';
            $response['message'] = 'You don\'t have access';

            return response()->json($response, 200);
        }
    }

    public function listAttendance()
    {
        $chairmanClass = isset(Auth::user()->customer->student) ?
            Auth::user()->customer->student->group_organisation_class_id :
            null;

        if ($chairmanClass != null || $chairmanClass == GlobalComponentCode::$GROUP_ORGANISATION_CLASS['CHAIRMAN']) {

            return AttendanceStudentLogic::listStudent();
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'Not access';
            $response['message'] = 'You don\'t have access';

            return response()->json($response, 200);
        }
    }

    public function CheckAttend(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attendanceId' => 'required',
            'studentId' => 'required',
            'attend' => 'required'
        ]);

        if ($validator->fails()) {

            $response['isFailed'] = true;
            $response['status'] = 'empty';
            $response['message'] = 'Student id is empty';

            return response()->json($response, 200);
        }

        AttendanceStudentProcess::dispatch($request)->onConnection('database')->onQueue('default');

        $response['isFailed'] = false;
        $response['status'] = 'success';
        $response['message'] = 'Attendance has being processed';

        return response()->json($response, 200);
    }
}
