<?php

namespace App\Repositories\School\v1\Logics;

use App\Http\Controllers\BackEnd\Browser\v1\Traits\Config;
use App\Repositories\Account\v1\Models\User;
use App\Repositories\Components\v1\Models\Department;
use App\Repositories\Components\v1\Transformers\DepartmentTransformer;
use App\Repositories\RegistrationStudent\v1\Models\RegistrationQuestionTest;
use App\Repositories\RegistrationStudent\v1\Models\RegistrationStudent;
use App\Repositories\School\v1\Logics\AddSchoolUseCase;
use App\Repositories\School\v1\Models\DetailQuestion;
use App\Repositories\School\v1\Models\GallerySchool;
use App\Repositories\School\v1\Models\Question;
use App\Repositories\School\v1\Models\QuestionDetail;
use App\Repositories\School\v1\Models\QuestionTest;
use App\Repositories\School\v1\Models\School;
use App\Repositories\Student\v1\Models\Student;
use App\Repositories\Student\v1\Models\StudentQuestionTest;
use App\Traits\v1\Globals\GlobalComponentCode;
use App\Traits\v1\Globals\GlobalUtils;
use App\Repositories\School\v1\Transformers\SchoolTransformer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuestionLogics extends QuestionUseCase
{
    use GlobalUtils;

    public function handleAddQuestion($request)
    {
        $createQuestion = Question::create([
            'id' => $this->uuid(),
            'group_question_id' => $request->group_question_id,
            'type_question_id' => $request->type_question_id,
            'school_id' => Auth::user()->school_id,
            'teacher_id' => '-',
            'code' => rand(123456789, 999999999),
            'name' => $request->name,
            'date_question' => $request->date_question,
            'deadline' => $request->dealine,
        ]);

        if ($createQuestion) {

            $createDetailQuestion = '';
            $resultQuestionSuccess = [];
            $resultQuestionFailed = [];

            for ($i = 0; $i < count($request->contents); $i++) {

                $createDetailQuestion = QuestionDetail::create([
                    'id' => $this->uuid(),
                    'question_id' => $createQuestion->id,
                    'content' => $request[$i]->contents,
                    'answer_a' => $request[$i]->answer_a,
                    'answer_b' => $request[$i]->answer_b,
                    'answer_c' => $request[$i]->answer_c,
                    'answer_d' => $request[$i]->answer_d,
                    'answer_e' => $request[$i]->answer_e,
                    'answer_true' => $request[$i]->answer_true
                ]);

                if (!$createDetailQuestion) {
                    $resultQuestionFailed[] = [
                        'content' => $request[$i]->contents,
                        'answer_a' => $request[$i]->answer_a,
                        'answer_b' => $request[$i]->answer_b,
                        'answer_c' => $request[$i]->answer_c,
                        'answer_d' => $request[$i]->answer_d,
                        'answer_e' => $request[$i]->answer_e,
                        'answer_true' => $request[$i]->answer_true
                    ];
                } else {
                    $resultQuestionSuccess[] = $createDetailQuestion->id;
                }

            }

            if ($createDetailQuestion != '') {

                $response['isFailed'] = false;
                $response['status'] = 'success';
                $response['message'] = 'Create Question success';
                $response['result'] = [
                    'success' => $resultQuestionSuccess,
                    'failed' => $resultQuestionFailed
                ];

                return response()->json($response, 200);
            } else {

                $response['isFailed'] = true;
                $response['status'] = 'failed';
                $response['message'] = 'Create Question failed';

                return response()->json($response, 200);
            }
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'failed';
            $response['message'] = 'Can\'t create question.js';

            return response()->json($response, 200);
        }

    }

    public function handleUploadQuestionRegistration($request)
    {
        $question = Question::where('group_question_id', $request->group_question_id)
            ->where('type_question_id', $request->type_question_id)
            ->where('school_id', $request->school_id)
            ->where('date_question', $request->date_question)
            ->get();

        if ($question) {

            $addQuestionTest = '';
            $resultSuccess = [];
            $resultError = [];

            $questionRandom = array_random($question);

            foreach ($request->registration_id as $registrationId) {

                $questionId = [];
                $questionTestId = $this->uuid();

                foreach ($questionRandom as $question) {
                    $questionId = $question->id;
                }

                $addQuestionTest = RegistrationQuestionTest::create([
                    'id' => $questionTestId,
                    'school_id' => $request->school_id,
                    'registration_id' => $registrationId,
                    'group_participant_id' => $request->group_participant_id,
                    'question_id' => $questionId,
                    'date_answer' => $request->date_answer,
                    'processing_time' => $request->deadline,
                    'status' => GlobalComponentCode::$STATUS_QUESTION_TEST['UPLOAD'],
                ]);

                if (!$addQuestionTest) {
                    $resultError[] = $this->handleResultQuestionTestRegistration($questionTestId, $registrationId);
                } else {
                    $resultSuccess[] = $this->handleResultQuestionTestRegistration($questionTestId, $registrationId);
                }
            }

            if ($addQuestionTest != '') {

                $response['isFailed'] = false;
                $response['status'] = 'success';
                $response['message'] = 'Upload question.js for registration success';
                $response['result'] = [
                    'success' => $resultSuccess,
                    'error' => $resultError
                ];

                return response()->json($response, 200);
            } else {

                $response['isFailed'] = true;
                $response['status'] = 'failed';
                $response['message'] = 'Upload data question.js failed';

                return response()->json($response, 200);
            }
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'null';
            $response['message'] = 'Sorry question.js not found';

            return response()->json($response, 200);
        }

    }

    private function handleResultQuestionTestRegistration($questionTestId, $registrationId)
    {
        $result = [
            'id' => $questionTestId,
            'name' => RegistrationStudent::where('id', $registrationId)->first()->full_name
        ];

        return $result;
    }

    public function handleQuestionRegistrationStatus($request)
    {
        $resultSuccess = array();
        $resultError = array();
        $getError = false;

        foreach ($request->question_test_id as $questionTestId) {

            $getQuestionTest = RegistrationQuestionTest::find($questionTestId);

            if ($getQuestionTest) {

                $getQuestionTest->status = GlobalComponentCode::$STATUS_QUESTION_TEST['READ'];

                if ($getQuestionTest->save()) {
                    $resultSuccess[] = [
                        'id' => !is_null($getQuestionTest->registration) ? $getQuestionTest->registration->id : '',
                        'name' => !is_null($getQuestionTest->registration) ? $getQuestionTest->registration->full_name : ''
                    ];
                } else {
                    $resultError[] = [
                        'id' => !is_null($getQuestionTest->registration) ? $getQuestionTest->registration->id : '',
                        'name' => !is_null($getQuestionTest->registration) ? $getQuestionTest->registration->full_name : ''
                    ];
                }
            } else {
                $getError[] = [
                    'status' => null,
                    'message' => 'Get registration question.js failed',
                    'result' => [
                        'id' => $questionTestId,
                        'name' => Question::where('id', $request->question_id)->first()->name,
                    ]
                ];
            }
        }

        if ($resultSuccess != array()) {

            $response['isFailed'] = false;
            $response['status'] = 'success';
            $response['message'] = 'Update status question.js registration success';
            $response['result'] = ['withError' => $getError, 'success' => $resultSuccess, 'error' => $resultError];

            return response()->json($response, 200);
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'failed';
            $response['message'] = 'Update status question.js registration failed';

            return response()->json($response, 200);
        }
    }
}