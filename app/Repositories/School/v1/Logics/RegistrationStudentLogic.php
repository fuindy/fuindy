<?php

namespace Fuindy\Repositories\School\v1\Logics;

use Fuindy\Repositories\Account\v1\Models\User;
use Fuindy\Repositories\RegistrationStudent\v1\Models\MessageRegistration;
use Fuindy\Repositories\RegistrationStudent\v1\Models\RegistrationDate;
use Fuindy\Repositories\RegistrationStudent\v1\Models\RegistrationStudent;
use Fuindy\Repositories\School\v1\Logics\AddSchoolUseCase;
use Fuindy\Repositories\School\v1\Models\School;
use Fuindy\Repositories\School\v1\Transformers\RegistrationStudentTransformation;
use Fuindy\Repositories\Student\v1\Models\Student;
use Fuindy\Traits\v1\Globals\GlobalComponentCode;
use Fuindy\Traits\v1\Globals\GlobalUtils;
use Fuindy\Repositories\School\v1\Transformers\SchoolTransformer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegistrationStudentLogic extends RegistrationStudentUseCase
{
    use GlobalUtils;

    public function handleRegistrationDate($request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date_format:d/m/Y',
            'end_date' => 'required|date_format:d/m/Y'
        ]);

        if ($validator->fails()) {

            $response['isFailed'] = true;
            $response['status'] = 'empty';
            $response['message'] = 'Missing required dates';

            return response()->json($response, 200);
        }

        $registrationDate = RegistrationDate::create([
            'school_id' => isset(Auth::user()->school_id) ? Auth::user()->school_id : "ece03385-8e6d-3152-ba4c-16a5fa74ed73",
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);

        if ($registrationDate) {

            $response['isFailed'] = false;
            $response['status'] = 'success';
            $response['message'] = 'Created registration date success.';

            return response()->json($response, 200);
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'error';
            $response['message'] = 'Created registration date failed.';

            return response()->json($response, 200);
        }

    }

    public function handleConfirmRegistration($request)
    {
        $validator = Validator::make($request->all(), [
            'registration_student_id' => 'required',
            'status_registration_id' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {

            $response['isFailed'] = true;
            $response['status'] = 'empty';
            $response['message'] = 'Missing your data registration';

            return response()->json($response, 200);
        }

        $statusRegistration = RegistrationStudent::find($request->registration_student_id);

        if ($statusRegistration) {

            if ($request->status_registration_id != 6) {

                $statusRegistration->status_registration_id = $request->status_registration_id;

                if ($statusRegistration->save()) {


                    $messageRegistration = MessageRegistration::create([
                        'id' => $this->uuid(),
                        'school_id' => isset(Auth::user()->school_id) ? Auth::user()->school_id : "ece03385-8e6d-3152-ba4c-16a5fa74ed73",
                        'registration_student_id' => $statusRegistration->id,
                        'message' => $request->message
                    ]);

                    if ($messageRegistration) {

                        $response['isFailed'] = false;
                        $response['status'] = 'success';
                        $response['message'] = 'Registration has confirmed';
                        $response['result'] = fractal($messageRegistration, new RegistrationStudentTransformation());

                        return response()->json($response, 200);
                    } else {

                        $response['isFailed'] = true;
                        $response['status'] = 'failed';
                        $response['message'] = 'Message can\'t sent';

                        return response()->json($response, 200);
                    }
                } else {

                    $response['isFailed'] = true;
                    $response['status'] = 'failed';
                    $response['message'] = 'Status registration can\'t be changed';

                    return response()->json($response, 200);
                }

            } else {

                $statusRegistration->status_registration_id = $request->status_registration_id;

                if ($statusRegistration->save()) {

                    $response['isFailed'] = false;
                    $response['status'] = 'success';
                    $response['message'] = 'student declared not accepted. Has confirmed';
                    $response['result'] = ['registrationId' => $statusRegistration->id];

                    return response()->json($response, 200);
                } else {

                    $response['isFailed'] = true;
                    $response['status'] = 'failed';
                    $response['message'] = 'Not accepted student can\'t confirm';

                    return response()->json($response, 200);
                }
            }
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'null';
            $response['message'] = 'Nothing in the registration list';

            return response()->json($response, 200);
        }

    }

    public function handleAcceptedStudent($request)
    {
        $validator = Validator::make($request->all(), [
            'registration_id' => 'required',
            'student_class_id' => 'required'
        ]);

        if ($validator->fails()) {

            $response['isFailed'] = true;
            $response['status'] = 'empty';
            $response['message'] = 'Data registration does not exist';

            return response()->json($response, 200);
        }

        $getRegistration = RegistrationStudent::find($request->registration_id);

        if ($getRegistration) {

            $getStudent = Student::where('customer_id', $getRegistration->customer_id)
                ->where('NISN', $getRegistration->NISN)
                ->where('email', $getRegistration->email)
                ->first(['id']);

            $studentId = ($getStudent) ? $getStudent->id : $this->uuid();

            $acceptedStudent = Student::updateOrCreate(
                [
                    'customer_id' => $getRegistration->customer_id,
                    'NISN' => $getRegistration->NISN,
                    'email' => $getRegistration->email
                ],
                [
                    'id' => $studentId,
                    'school_id' => $getRegistration->school_id,
                    'department_id' => !is_null($request->department_id) ? $request->department_id : $getRegistration->department_id,
                    'student_class_id' => $request->student_class_id,
                    'religion_id' => $getRegistration->religion_id,
                    'full_name' => $getRegistration->full_name,
                    'place_of_birth' => $getRegistration->place_of_birth,
                    'date_of_birth' => $getRegistration->date_of_birth,
                    'phone_no' => $getRegistration->phone_no,
                    'hobby' => $getRegistration->hobby,
                    'purpose' => $getRegistration->purpose,
                    'address' => $getRegistration->address,
                    'stay_with' => $getRegistration->stay_with,
                    'distance_to_school' => $getRegistration->distance_to_school,
                    'father_name' => $getRegistration->father_name,
                    'father_occupation' => $getRegistration->father_occupation,
                    'father_place_birth' => $getRegistration->father_place_birth,
                    'father_date_birth' => $getRegistration->father_date_birth,
                    'father_income' => $getRegistration->father_income,
                    'mother_name' => $getRegistration->mother_name,
                    'mother_occupation' => $getRegistration->mother_occupation,
                    'mother_place_birth' => $getRegistration->mother_place_birth,
                    'mother_date_birth' => $getRegistration->mother_date_birth,
                    'mother_income' => $getRegistration->mother_income,
                    'trustee_name' => $getRegistration->trustee_name,
                    'trustee_occupation' => $getRegistration->trustee_occupation,
                    'trustee_place_birth' => $getRegistration->trustee_place_birth,
                    'trustee_date_birth' => $getRegistration->trustee_date_birth,
                    'trustee_income' => $getRegistration->trustee_income,
                    'status_student_id' => GlobalComponentCode::$STATUS_STUDENT['STUDENT'],
                ]
            );

            if ($acceptedStudent) {

                $response['isFailed'] = false;
                $response['status'] = 'success';
                $response['message'] = 'student account has success registered';

                return response()->json($response, 200);
            } else {

                $response['isFailed'] = true;
                $response['status'] = 'failed';
                $response['message'] = 'Failed to register student account';

                return response()->json($response, 200);
            }
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'null';
            $response['message'] = 'Data registration not found';

            return response()->json($response, 200);
        }

    }
}