<?php

namespace App\Repositories\School\v1\Logics;

use App\Repositories\Account\v1\Models\User;
use App\Repositories\RegistrationStudent\v1\Models\MessageRegistration;
use App\Repositories\RegistrationStudent\v1\Models\RegistrationDate;
use App\Repositories\RegistrationStudent\v1\Models\RegistrationStudent;
use App\Repositories\School\v1\Logics\AddSchoolUseCase;
use App\Repositories\School\v1\Models\School;
use App\Repositories\School\v1\Transformers\RegistrationStudentTransformation;
use App\Repositories\Student\v1\Models\Student;
use App\Traits\v1\Globals\GlobalUtils;
use App\Repositories\School\v1\Transformers\SchoolTransformer;
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
            $response['status'] = 'error';
            $response['message'] = 'Missing required dates.';

            return response()->json($response, 200);
        }

        $registrationDate = RegistrationDate::create([
            'school_id' => Auth::user()->school_id,
//            'school_id' => '95552d62-1300-3f5a-aed9-08a4697dfd90',
            'start_date' => $request->start_date,
            'end_date' => $request->end_Date
        ]);

        if ($registrationDate) {
            $response['status'] = 'success';
            $response['message'] = 'Created registration date success.';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Created registration date failed.';
        }

        return response()->json($response, 200);
    }

    public function handleConfirmRegistration($request)
    {
        $statusRegistration = RegistrationStudent::find($request->registration_student_id);

        if ($statusRegistration) {

            if ($request->status_registration_id != 6) {

                $statusRegistration->status_registration_id = $request->status_registration_id;

                if ($statusRegistration->save()) {

                    //
                    $messageRegistration = MessageRegistration::create([
                        'id' => $this->uuid(),
                        'school_id' => Auth::user()->school_id,
                        'registration_student_id' => $statusRegistration->id,
                        'message' => $request->message
                    ]);

                    if ($messageRegistration) {

                        $response['status'] = 'success';
                        $response['message'] = 'Registration has confirmed';
                        $response['result'] = fractal($messageRegistration, new RegistrationStudentTransformation());

                    } else {

                        $response['status'] = 'error';
                        $response['message'] = 'Message can\'t sent';

                    }

                } else {

                    $response['status'] = 'error';
                    $response['message'] = 'Status registration can\'t be changed';

                }

            } else {

                $statusRegistration->status_registration_student = $request->status_registration_id;

                if ($statusRegistration->save()) {

                    $response['status'] = 'true';
                    $response['message'] = 'Student declared not accepted. Has confirmed';
                    $response['result'] = ['registrationId' => $statusRegistration->id];

                } else {

                    $response['status'] = 'error';
                    $response['message'] = 'Not accepted student can\'t confirm';

                }

            }

        } else {

            $response['status'] = 'error';
            $response['message'] = 'Nothing in the registration list';

        }

        return response()->json($response, 200);

    }

    public function handleAcceptedStudent($request)
    {
        $request->request->add(['id' => $this->uuid()]);

        $acceptedStudent = Student::create($request->all());

        if ($acceptedStudent) {

            $response['status'] = 'success';
            $response['message'] = 'Student account has success registered';

        } else {

            $response['status'] = 'error';
            $response['message'] = 'Failed to register student account';

        }

        return response()->json($response, 200);
    }
}