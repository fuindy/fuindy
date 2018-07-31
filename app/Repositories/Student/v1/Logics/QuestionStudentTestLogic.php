<?php

namespace App\Repositories\Student\v1\Logics;

use App\Repositories\Components\v1\Models\HistoryQuestion;
use App\Repositories\School\v1\Models\QuestionDetail;
use App\Repositories\Student\v1\Models\StudentQuestionTest;
use App\Repositories\Student\v1\Models\StudentQuestionTestDetail;
use App\Repositories\Student\v1\Transformers\ListQuestionTransformer;
use App\Repositories\Student\v1\Transformers\ViewQuestionTransformer;
use App\Traits\v1\Globals\GlobalComponentCode;
use App\Traits\v1\Globals\GlobalUtils;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class QuestionStudentTestLogic extends QuestionStudentTestUseCase
{
    use GlobalUtils;

    public function handleGetListQuestion()
    {
        $getStudent = !is_null(Auth::user()->customer->student) ? Auth::user()->customer->student : null;

        if ($getStudent != null) {

            $getQuestion = StudentQuestionTest::where('student_id', $getStudent->id)
                ->where('school_id', $getStudent->school_id)
                ->where('class_id', $getStudent->class_id)
                ->where('department_id', $getStudent->department_id)
                ->get();

            if ($getQuestion) {

                $response['isFailed'] = false;
                $response['status'] = 'success';
                $response['message'] = 'View list question.js success';
                $response['result'] = fractal($getQuestion, new ListQuestionTransformer());

                return response()->json($response);
            } else {

                $response['isFailed'] = true;
                $response['status'] = 'null';
                $response['message'] = 'View list question.js success';

                return response()->json($response);
            }
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'null';
            $response['message'] = 'User student not found';

            return response()->json($response);
        }

    }

    public function handleGetQuestionStudent($request)
    {
        $getQuestion = StudentQuestionTest::find($request->question_test_id);

        if ($getQuestion) {

            $response['isFailed'] = false;
            $response['status'] = 'success';
            $response['message'] = 'Question has a found';
            $response['result'] = fractal($getQuestion, new ViewQuestionTransformer());

            return response()->json($response, 200);
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'null';
            $response['message'] = 'Question not found';

            return response()->json($response, 200);
        }
    }

    public function handleCheckAnswerStudent($request)
    {
        $statusQuestion = StudentQuestionTest::find($request->question_test_id);

        if ($statusQuestion) {

            $statusQuestion->date_answer = Carbon::createFromFormat('d/m/Y', Carbon::now()->format('d/m/Y'));
            $statusQuestion->status = GlobalComponentCode::$STATUS_QUESTION_TEST['FINISH'];

            if ($statusQuestion->save()) {
                $questionAnswerDetail = '';
                $resultSuccess = '';
                $resultError = '';

//                $response['message'] = 'Thank you has been working on the question.js, your answer is being processed';

                for ($i = 0; $i < count($request->question_detail_id); $i++) {

                    $questionDetailId = $request->question_detail_id[$i];

                    $getAnswer = QuestionDetail::where('id', $questionDetailId)
                        ->where('question_id', $request->question_id)
                        ->first()
                        ->answer_true;

                    if ($getAnswer) {

                        $answer = ($getAnswer == $request->answer[$i]) ? 1 : 0;

                        $questionAnswerDetail = StudentQuestionTestDetail::create([
                            'id' => $this->uuid(),
                            'question_detail_id' => $questionDetailId,
                            'question_test_id' => $request->question_test_id,
                            'answer' => $request->answer[$i],
                            'result_answer' => $answer,
                            'correct' => $getAnswer,
                        ]);

                        if ($questionAnswerDetail) {
                            $resultSuccess[] = $questionAnswerDetail->question_detail_id;
                        } else {
                            $resultError[] = $questionDetailId;
                        }
                    }
                }

                if ($questionAnswerDetail != '') {

                    $saveHistory = HistoryQuestion::create([
                        'question_id' => $request->question_test_id,
                        'school_id' => $request->school_id,
                        'participant_id' => $request->student_id,
                        'type' => 'student',
                        'processing_time' => $request->processing_time,
                        'success' => count($resultSuccess),
                        'error' => count($resultError)
                    ]);

                    if ($saveHistory) {

                        $response['isFailed'] = false;
                        $response['status'] = 'success';
                        $response['message'] = 'Your answer has been processed';

                        return response()->json($response);
                    } else {

                        $response['isFailed'] = true;
                        $response['status'] = 'failed';
                        $response['message'] = 'There was an error when backup the data';

                        return response()->json($response);
                    }
                } else {

                    $response['isFailed'] = true;
                    $response['status'] = 'failed';
                    $response['message'] = 'Your answer can\'t processed';

                    return response()->json($response);
                }
            } else {

                $response['isFailed'] = true;
                $response['status'] = 'failed';
                $response['message'] = 'Your question.js can\'t processed';

                return response()->json($response);
            }
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'null';
            $response['message'] = 'Your question.js not found';

            return response()->json($response);
        }
    }

}