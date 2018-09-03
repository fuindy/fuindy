<?php

namespace Fuindy\Http\Controllers\BackEnd\Browser\v1\RegistrationStudent;

use Fuindy\Repositories\RegistrationStudent\v1\Jobs\AnswerQuestion;
use Fuindy\Repositories\RegistrationStudent\v1\Logics\QuestionRegistrationLogic;
use Fuindy\Traits\v1\Globals\GlobalUtils;
use Illuminate\Http\Request;
use Fuindy\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class QuestionRegistrationTestController extends Controller
{

    use GlobalUtils;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkAnswerRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_id' => 'required',
            'question_detail_id' => 'required',
            'question_test_id' => 'required',
            'school_id' => 'required',
            'registration_id' => 'required',
            'answer' => 'required',
            'processing_time' => 'required',
        ]);

        if ($validator->fails()) {

            $response['isFailed'] = true;
            $response['status'] = 'empty';
            $response['message'] = 'missing your question.js answer';

            return response()->json($response, 200);
        }

        AnswerQuestion::dispatch($request, $this->getUserRequest())->onConnection('database')->onQueue('default');

        $response['isFailed'] = false;
        $response['status'] = 'success';
        $response['message'] = 'Answer being processed';

        return response()->json($response, 200);
//        return QuestionRegistrationLogic::checkAnswerRegistration($request);
    }
}
