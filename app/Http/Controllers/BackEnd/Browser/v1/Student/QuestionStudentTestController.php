<?php

namespace App\Http\Controllers\BackEnd\Browser\v1\Student;

use App\Repositories\Student\v1\Jobs\AnswerQuestion;
use App\Repositories\Student\v1\Logics\QuestionStudentTestLogic;
use App\Traits\v1\Globals\GlobalUtils;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class QuestionStudentTestController extends Controller
{
    use GlobalUtils;

    public function getListQuestion()
    {
        QuestionStudentTestLogic::getListQuestion();
    }

    public function getQuestionStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_test_id' => 'required'
        ]);

        if ($validator->fails()) {

            $response['isFailed'] = true;
            $response['status'] = 'empty';
            $response['message'] = 'Data question.js your that select is empty';

            return response()->json($response, 200);
        }

        return QuestionStudentTestLogic::getQuestionStudent($request);
    }

    public function checkAnswerStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_id' => 'required',
            'question_detail_id' => 'required',
            'question_test_id' => 'required',
            'school_id' => 'required',
            'student_id' => 'required',
            'answer' => 'required',
            'processing_time' => 'required',
        ]);

        if ($validator->fails()) {

            $response['isFailed'] = true;
            $response['status'] = 'empty';
            $response['message'] = 'Missing your question.js answer';

            return response()->json($response, 200);
        }

        AnswerQuestion::dispatch($request, $this->getUserRequest())->onConnection('database')->onQueue('default');

        $response['isFailed'] = false;
        $response['status'] = 'success';
        $response['message'] = 'Answer being processed';

        return response()->json($response, 200);
    }
}
