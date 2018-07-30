<?php

namespace App\Http\Controllers\BackEnd\Browser\v1\School;

use App\Repositories\Components\v1\Models\GroupParticipantQuestionTest;
use App\Repositories\Components\v1\Transformers\BasicComponentTransformer;
use App\Repositories\School\v1\Logics\QuestionLogics;
use App\Repositories\School\v1\Transformers\ListQuestionTestTransformer;
use App\Repositories\School\v1\Transformers\ListQuestionTransformer;
use App\Traits\v1\Globals\GlobalComponentCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{

    public function __construct()
    {
//        $this->middleware('auth.school');
    }

    public function addQuestion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'group_question_id' => 'required',
            'type_question_id' => 'required',
            'date_question' => 'required|date_format:d/m/Y',
            'name' => 'required',
            'contents' => 'required',
            'answer_a' => 'required',
            'answer_b' => 'required',
            'answer_c' => 'required',
            'answer_d' => 'required',
            'answer_e' => 'required',
        ]);

        if ($validator->fails()) {

            $response['isFailed'] = true;
            $response['status'] = 'empty';
            $response['message'] = 'Missing required question.js';

            return response()->json($response, 200);
        }

        return QuestionLogics::addQuestion($request);
    }

    public function uploadQuestionRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'registration_id' => 'required',
            'school_id' => 'required',
            'group_question_id' => 'required',
            'type_question_id' => 'required',
            'date_question' => 'require',
            'processing_time' => 'required',
        ]);

        if ($validator->fails()) {
            $response['isFailed'] = true;
            $response['status'] = 'empty';
            $response['message'] = 'Missing your data upload';
            return response($response, 200);
        }

        return QuestionLogics::uploadQuestionRegistration($request);
    }

    public function getComponent()
    {
        $schoolId = !is_null(Auth::user()->school) ? Auth::user()->school->id : null;

        if ($schoolId) {

            $groupParticipant = GroupParticipantQuestionTest::where('status', GlobalComponentCode::$TYPE_QUESTION['REGISTRATION'])
                ->where('school_id', $schoolId)
                ->get();

            if ($groupParticipant) {

                $response['isFailed'] = false;
                $response['status'] = 'success';
                $response['message'] = 'success get data';
                $response['result'] = [
                    'groupParticipant' => fractal($groupParticipant, new BasicComponentTransformer())
                ];

                return response()->json($response, 200);
            } else {

                $response['isFailed'] = true;
                $response['status'] = 'null';
                $response['message'] = 'Data not found';

                return response()->json($response, 200);
            }
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'null';
            $response['message'] = 'Your school does not exist';

            return response()->json($response, 200);
        }
    }

    public function getQuestionRegistration(Request $request)
    {
        $schoolId = !is_null(Auth::user()->school) ? Auth::user()->school->id : null;

        if ($schoolId) {

            $searchDateQuestion = !is_null($request->date_question) ? "AND `date_question` LIKE '%$request->date_question%'" : "";
            $groupQuestionId = GlobalComponentCode::$GROUP_QUESTION['REGISTRATION_STUDENT'];

            $getQuestion = DB::select("SELECT * FROM `questions` 
                WHERE `group_question_id` = '$groupQuestionId' AND `school_id` = '$schoolId'
                $searchDateQuestion ORDER BY `created_at` DESC");

            if ($getQuestion) {

                $response['isFailed'] = false;
                $response['status'] = 'success';
                $response['message'] = 'Success get data question.js';
                $response['result'] = fractal($getQuestion, new ListQuestionTransformer());

                return response()->json($response, 200);
            } else {

                $response['isFailed'] = true;
                $response['status'] = 'null';
                $response['message'] = 'Data question.js not found';

                return response()->json($response, 200);
            }
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'null';
            $response['message'] = 'Your school does not exist';

            return response()->json($response, 200);
        }

    }

    public function getQuestionRegistrationDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_id' => 'required'
        ]);

        if ($validator->fails()) {

            $response['isFailed'] = true;
            $response['status'] = 'empty';
            $response['message'] = 'Missing question.js id required';

            return response()->json($response, 200);
        }

        $searchGroupParticipant = !is_null($request->group_participant_id) ? "AND `group_participant_id` LIKE '%$request->group_participant_id%'" : "";

        $getQuestionDetail = DB::select("SELECT * FROM `registration_question_test` 
            WHERE `question_id` = '$request->question_id'
            $searchGroupParticipant ORDER BY `cleared_at` DESC");

        if ($getQuestionDetail) {

            $response['isFailed'] = false;
            $response['status'] = 'success';
            $response['message'] = 'Success get data question.js registration';
            $response['result'] = fractal($getQuestionDetail, new ListQuestionTestTransformer());

            return response()->json($response, 200);
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'null';
            $response['message'] = 'Data question.js not found';

            return response()->json($response, 200);
        }

    }

    public function questionRegistrationStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_id' => 'required',
            'question_test_id' => 'required',
        ]);

        if ($validator->fails()) {

            $response['isFailed'] = true;
            $response['status'] = 'empty';
            $response['message'] = 'Your the data request for update status is empty';

            return response()->json($response, 200);
        }

        return QuestionLogics::questionRegistrationStatus($request);
    }

}
