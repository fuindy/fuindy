<?php

namespace App\Repositories\RegistrationStudent\v1\Logics;

use App\Http\Controllers\BackEnd\Browser\v1\Traits\Config;
use App\Repositories\RegistrationStudent\v1\Models\RegistrationAttachment;
use App\Repositories\RegistrationStudent\v1\Models\RegistrationDate;
use App\Repositories\RegistrationStudent\v1\Models\RegistrationStudent;
use App\Repositories\School\v1\Models\School;
use App\Repositories\Student\v1\Models\Student;
use App\Traits\v1\Globals\GlobalUtils;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegistrationStudentLogic extends RegistrationStudentUseCase
{
    use GlobalUtils;

    public function handleGetSchool()
    {
        $today = Carbon::now()->format('d/m/Y');

        $getRegister = RegistrationDate::where('start_date', '<=', $today)->where('end_date', '>=', $today)->get();

        if ($getRegister) {
            $resultSchool = [];

            $student = Student::where('customer_id', Auth::user()->customer_id)->first();

            $resultStudent = ($student == true) ? $student : [];

            foreach ($getRegister as $dataRegister) {

                $school = School::where('id', $dataRegister['school_id'])->get();

                if ($school) {

                    foreach ($school as $dataSchool) {
                        $resultSchool[] = [
                            'id' => $dataSchool->id,
                            'name' => $dataSchool->school_name,
                            'email' => $dataSchool->email,
                            'date' => [
                                'start' => $dataSchool->registerDate->start_date,
                                'end' => $dataSchool->registerDate->end_date,
                            ],
                        ];
                    }

                }

            }

            $response['status'] = 'success';
            $response['message'] = 'Success get data school for registration new student';
            $response['result'] = [
                'data' => [
                    'school' => $resultSchool,
                    'student' => $resultStudent
                ]
            ];

            return response()->json($response, 200);

        } else {
            $response['status'] = 'error';
            $response['message'] = 'There\'s not data school today';

            return response()->json($response, 200);
        }
    }

    public function handleRegistration($request)
    {
        !is_null($request->id) ? $request->id : $request->request->add(['id' => $this->uuid()]);

        $registrationStudent = RegistrationStudent::create($request->all());

        if ($registrationStudent) {
            $response['status'] = 'success';
            $response['message'] = 'Entry data success, please next step.';
            $response['result'] = ['studentId' => $registrationStudent->id];
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Entry data failed, please try again.';
            $response['result'] = [];
        }

        return response()->json($response, 200);
    }

    public function handleRegistrationAttachment($request)
    {
        $savePhoto = '';
        $registerAttachment = '';

        /*Handle image uploads*/
        if ($request->hasFile('profile_image') && $request->file('profile_image')->isValid()) {

            /*Save new image*/
            $newProfileName = $this->getPhotoName($request->profile_image, str_random(5));
            $destinationProfilePath = Config::$IMAGE_PATH['PROFILE_REGISTER'];
            $moveProfileImage = $request->profile_image->move($destinationProfilePath, $newProfileName);

            if ($moveProfileImage) {

                $registerStudent = RegistrationStudent::find($request->student_id);
                $registerStudent->profile_image = $newProfileName;

                $savePhoto = $registerStudent->save();
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Your photo personal can\'t saved.';
                $response['result'] = [];
            }
        }

        /*Handle image uploads*/
        if ($request->hasFile('attachment') && $request->file('attachment')->isValid()) {

            $attachments = $request->file('attachment');

            foreach ($attachments as $attachment) {

                /*Save new image*/
                $newAttachmentName = $this->getPhotoName($attachment, str_random(5));
                $destinationAttachmentPath = Config::$IMAGE_PATH['ATTACHMENT_IMAGE'];
                $moveAttachmentImage = $attachment->move($destinationAttachmentPath, $newAttachmentName);

                if ($moveAttachmentImage) {
                    $registerAttachment = RegistrationAttachment::create([
                        'registration_student_id' => $request->student_id,
                        'attachment' => $newAttachmentName
                    ]);
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Your photo attachment can\'t saved.';
                    $response['result'] = [];
                }

            }

        }

        if ($savePhoto != '' || $registerAttachment != '') {

            if ($registerAttachment) {
                $resultAttachment = $this->responseSuccessPhoto($registerAttachment);
            } else {
                $resultAttachment = $this->responseErrorPhoto();
            }

            if ($savePhoto) {
                $resultProfile = $this->responseSuccessPhoto($savePhoto);
            } else {
                $resultProfile = $this->responseErrorPhoto();
            }

            $response['status'] = 'success';
            $response['message'] = 'Your photo has been saved.';
            $response['result'] = [
                'profile' => $resultProfile,
                'attachment' => $resultAttachment
            ];

        } else {
            $response['status'] = 'error';
            $response['message'] = 'Your photo for a profile and attachment can\'t saved.';
            $response['result'] = [];
        }

        return response()->json($response);
    }

    private function responseSuccessPhoto($responsePhoto)
    {
        $data = [
            'status' => 'success',
            'message' => 'Success saved your photo.',
            'result' => $responsePhoto
        ];

        return $data;
    }

    private function responseErrorPhoto()
    {
        $data = [
            'status' => 'error',
            'message' => 'Can\'t saved your photo.',
            'result' => []
        ];

        return $data;
    }
}