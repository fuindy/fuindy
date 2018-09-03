<?php

namespace Fuindy\Repositories\Student\v1\Logics;

use Fuindy\Repositories\School\v1\Models\AttendanceSchoolSetting;
use Fuindy\Repositories\Student\v1\Jobs\CreateAttendanceSchool;
use Fuindy\Repositories\Student\v1\Models\AttendanceStudent;
use Fuindy\Repositories\Student\v1\Models\Student;
use Fuindy\Repositories\Student\v1\Models\StudentClass;
use Illuminate\Support\Facades\Auth;

class AttendanceStudentLogic extends AttendanceStudentUseCase
{
    public function handleCreateAttendance($request)
    {
        $chairman = Auth::user()->customer->student();

        if ($chairman) {

            $student = Student::where('student_class_id', $chairman->student_class_id)
                ->where('school_id', $chairman->school_id)
                ->where('department_id', $chairman->department_id)
                ->get();

            if ($student) {

                $attendanceSetting = AttendanceSchoolSetting::where('school_id', $student->school_id)
                    ->orWhereNull('school_id')
                    ->orderBy('id', 'DESC')
                    ->first();

                if ($attendanceSetting) {

                    if (count($attendanceSetting) <= 0) {

                        $response['isFailed'] = true;
                        $response['status'] = 'not exist';
                        $response['message'] = 'Data Attendance setting does not exist';

                        return response()->json($response, 200);
                    }

                    CreateAttendanceSchool::dispatch($student, $attendanceSetting, $request->all())->onConnection('database')->onQueue('default');

                    $response['isFailed'] = false;
                    $response['status'] = 'success';
                    $response['message'] = 'Attendance has been processed, please for waiting.';

                    return response()->json($response, 200);
                } else {

                    $response['isFailed'] = true;
                    $response['status'] = 'failed';
                    $response['message'] = 'Get data attendance setting failed';

                    return response()->json($response, 200);
                }

            } else {

                $response['isFailed'] = true;
                $response['status'] = 'failed';
                $response['message'] = 'Get data student failed';

                return response()->json($response, 200);
            }
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'Not found';
            $response['message'] = 'Student that you search, not found';

            return response()->json($response, 200);
        }
    }

    public function handleListStudent()
    {
        $chairman = Auth::user()->customer->student();

        if ($chairman) {

            $students = Student::where('student_class_id', $chairman->student_class_id)
                ->where('school_id', $chairman->school_id)
                ->where('department_id', $chairman->department_id)
                ->get();

            if ($students) {

                $resultStudent = array();
                foreach ($students as $student) {

                    $resultStudent[] = [
                        'id' => $student->id,
                        'name' => $student->full_name,
                        'phone' => $student->phone_no,
                        'school' => [
                            'id' => $student->school_id,
                            'name' => !is_null($student->school) ? $student->school->school_name : null
                        ],
                        'studentClass' => [
                            'id' => $student->student_class_id,
                            'name' => !is_null($student->class) ? $student->class->name : null
                        ],
                        'attend' => $this->handleAttendanceStudent($student->id)
                    ];
                }

                $response['isFailed'] = false;
                $response['status'] = 'success';
                $response['message'] = "Get data student success";
                $response['result'] = $resultStudent;

                return response()->json($response, 200);
            } else {

                $response['isFailed'] = true;
                $response['status'] = 'failed';
                $response['message'] = 'Get data student failed';

                return response()->json($response, 200);
            }
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'not found';
            $response['message'] = 'Chairman not found';

            return response()->json($response, 200);
        }
    }

    private function handleAttendanceStudent($studentId)
    {
        $attendanceStudent = AttendanceStudent::where('student_id', $studentId)->get();

        if ($attendanceStudent) {

            $resultAttendance = array();
            foreach ($attendanceStudent as $dataAttendance) {

                $resultAttendance[] = [
                    'id' => $dataAttendance->id,
                    'date' => $dataAttendance->date,
                    'time' => $dataAttendance->time,
                    'hourStudy' => $dataAttendance->hour_study,
                    'attend' => $dataAttendance->attend,
                    'explanation' => $dataAttendance->explanation,
                    'teacherConfirm' => $dataAttendance->teacher_confirm,
                    'explanationTeacher' => $dataAttendance->explanation_teacher
                ];
            }

            return $resultAttendance;
        } else {
            return array();
        }
    }

}