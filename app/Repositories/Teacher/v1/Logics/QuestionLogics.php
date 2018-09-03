<?php

namespace Fuindy\Repositories\Teacher\v1\Logics;

use Fuindy\Repositories\School\v1\Models\Question;
use Fuindy\Repositories\School\v1\Models\QuestionDetail;
use Fuindy\Repositories\Student\v1\Models\Student;
use Fuindy\Repositories\Student\v1\Models\StudentQuestionTest;
use Fuindy\Traits\v1\Globals\GlobalComponentCode;
use Fuindy\Traits\v1\Globals\GlobalUtils;
use Illuminate\Support\Facades\Auth;

class QuestionLogics extends QuestionUseCase
{
    use GlobalUtils;

//    public function handleAddQuestion($request)
//    {
//        $teacher = (Auth::user()->customer->teacher) ? Auth::user()->customer->teacher->id : null;
//
//        if ($teacher != null) {
//
//            $createQuestion = Question::create([
//                'id' => $this->uuid(),
//                'group_question_id' => $request->group_question_id,
//                'type_question_id' => $request->type_question_id,
//                'school_id' => $teacher->school_id,
//                'teacher_id' => $teacher->id,
//                'code' => rand(123456789, 999999999),
//                'name' => $request->name,
//                'date_question' => $request->date_question,
//                'deadline' => $request->dealine,
//            ]);
//
//            if ($createQuestion) {
//
//                $createDetailQuestion = '';
//                $resultQuestionSuccess = [];
//                $resultQuestionFailed = [];
//
//                for ($i = 0; $i < count($request->contents); $i++) {
//
//                    $createDetailQuestion = QuestionDetail::create([
//                        'id' => $this->uuid(),
//                        'question_id' => $createQuestion->id,
//                        'content' => $request[$i]->contents,
//                        'answer_a' => $request[$i]->answer_a,
//                        'answer_b' => $request[$i]->answer_b,
//                        'answer_c' => $request[$i]->answer_c,
//                        'answer_d' => $request[$i]->answer_d,
//                        'answer_e' => $request[$i]->answer_e,
//                        'answer_true' => $request[$i]->answer_true
//                    ]);
//
//                    if (!$createDetailQuestion) {
//                        $resultQuestionFailed[] = [
//                            'content' => $request[$i]->contents,
//                            'answer_a' => $request[$i]->answer_a,
//                            'answer_b' => $request[$i]->answer_b,
//                            'answer_c' => $request[$i]->answer_c,
//                            'answer_d' => $request[$i]->answer_d,
//                            'answer_e' => $request[$i]->answer_e,
//                            'answer_true' => $request[$i]->answer_true
//                        ];
//                    } else {
//                        $resultQuestionSuccess[] = $createDetailQuestion->id;
//                    }
//
//                }
//
//                if ($createDetailQuestion != '') {
//
//                    $response['isFailed'] = false;
//                    $response['status'] = 'success';
//                    $response['message'] = 'Create Question success';
//                    $response['result'] = [
//                        'success' => $resultQuestionSuccess,
//                        'failed' => $resultQuestionFailed
//                    ];
//
//                    return response()->json($response, 200);
//                } else {
//
//                    $response['isFailed'] = true;
//                    $response['status'] = 'failed';
//                    $response['message'] = 'Create Question failed';
//
//                    return response()->json($response, 200);
//                }
//            } else {
//
//                $response['isFailed'] = true;
//                $response['status'] = 'failed';
//                $response['message'] = 'Can\'t create question.js';
//
//                return response()->json($response, 200);
//            }
//        } else {
//
//            $response['isFailed'] = true;
//            $response['status'] = 'null';
//            $response['message'] = 'teacher does not exist';
//
//            return response()->json($response, 200);
//        }
//
//    }

    public function handleUploadQuestionStudent($request)
    {
        $addQuestionTest = '';
        $resultSuccess = array();
        $resultError = array();

        if ($request->department_id == null || $request->department_id == '') {
            $getStudent = Student::where('student_class_id', $request->student_class_id)
                ->where('department', $request->department_id)
                ->get();
        } else {
            $getStudent = Student::where('student_class_id', $request->student_class_id)->get();
        }

        if ($getStudent) {

            foreach ($getStudent as $student) {

                $questionId = (count($request->question_id) > 1) ? (count($request->question_id - 1)) : 0;
                $questionIdRandom = ($questionId != 0) ? rand(1, $questionId) : 0;

                $question = Question::where('id', $request->question_id[0])
                    ->orWhere('id', $request->question_id[$questionIdRandom])
                    ->inRandomOrder()
                    ->first();

                if ($question) {

                    $questionTestId = $this->uuid();

                    $addQuestionTest = StudentQuestionTest::create([
                        'id' => $questionTestId,
                        'school_id' => $student->school_id,
                        'student_id' => $student->id,
                        'class_id' => $student->student_class_id,
                        'department_id' => $student->department_id,
                        'group_participant_id' => $question->group_participant_id,
                        'question_id' => $question->id,
                        'date_answer' => $question->date_answer,
                        'processing_time' => $question->processing_time,
                        'status' => GlobalComponentCode::$STATUS_QUESTION_TEST['UPLOAD'],
                    ]);

                    if (!$addQuestionTest) {
                        $resultError[] = $this->handleResultQuestionUpload($questionTestId, $student->id);
                    } else {
                        $resultSuccess[] = $this->handleResultQuestionUpload($questionTestId, $student->id);
                    }
                }
            }

            if ($addQuestionTest != '') {

                $response['isFailed'] = false;
                $response['status'] = 'success';
                $response['message'] = 'Upload question.js for student success';
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
            $response['message'] = 'Sorry student in class not found';

            return response()->json($response, 200);
        }

    }

    private function handleResultQuestionUpload($questionTestId, $studentId)
    {
        $result = [
            'id' => $questionTestId,
            'name' => Student::where('id', $studentId)->first()->full_name
        ];

        return $result;
    }

    public function handleQuestionStudentStatus($request)
    {
        $resultSuccess = array();
        $resultError = array();
        $getError = false;

        foreach ($request->question_test_id as $questionTestId) {

            $getQuestionTest = StudentQuestionTest::find($questionTestId);

            if ($getQuestionTest) {

                $getQuestionTest->status = GlobalComponentCode::$STATUS_QUESTION_TEST['READ'];

                if ($getQuestionTest->save()) {
                    $resultSuccess[] = [
                        'id' => !is_null($getQuestionTest->student) ? $getQuestionTest->student->id : '',
                        'name' => !is_null($getQuestionTest->student) ? $getQuestionTest->student->full_name : ''
                    ];
                } else {
                    $resultError[] = [
                        'id' => !is_null($getQuestionTest->student) ? $getQuestionTest->student->id : '',
                        'name' => !is_null($getQuestionTest->student) ? $getQuestionTest->student->full_name : ''
                    ];
                }
            } else {
                $getError[] = [
                    'status' => null,
                    'message' => 'Get student question.js failed',
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
            $response['message'] = 'Update status question.js student success';
            $response['result'] = ['withError' => $getError, 'success' => $resultSuccess, 'error' => $resultError];

            return response()->json($response, 200);
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'failed';
            $response['message'] = 'Update status question.js student failed';

            return response()->json($response, 200);
        }
    }

}