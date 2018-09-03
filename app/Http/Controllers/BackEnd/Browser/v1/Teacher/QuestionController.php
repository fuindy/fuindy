<?php

namespace Fuindy\Http\Controllers\BackEnd\Browser\v1\Teacher;

use Fuindy\Repositories\Components\v1\Models\Department;
use Fuindy\Repositories\Components\v1\Models\GroupParticipantQuestionTest;
use Fuindy\Repositories\Components\v1\Models\TypeQuestion;
use Fuindy\Repositories\Components\v1\Transformers\BasicComponentTransformer;
use Fuindy\Repositories\School\v1\Transformers\ListQuestionTestTransformer;
use Fuindy\Repositories\School\v1\Transformers\ListQuestionTransformer;
use Fuindy\Repositories\Student\v1\Models\StudentClass;
use Fuindy\Repositories\Teacher\v1\Jobs\AddQuestion;
use Fuindy\Repositories\Teacher\v1\Logics\QuestionLogics;
use Fuindy\Traits\v1\Globals\GlobalComponentCode;
use Fuindy\Traits\v1\Globals\GlobalUtils;
use Illuminate\Http\Request;
use Fuindy\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{

    use GlobalUtils;

    public function __construct()
    {
//        $this->middleware('auth.teacher');
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
        };

        $teacher = (Auth::user()->customer->teacher) ? Auth::user()->customer->teacher->id : null;

        if ($teacher != null) {

            AddQuestion::dispatch($request, $teacher, $this->getUserRequest())->onConnection('database')->onQueue('default');

            $response['isFailed'] = false;
            $response['status'] = 'success';
            $response['message'] = 'Question being processed';

            return response()->json($response, 200);
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'error';
            $response['message'] = 'teacher not found';

            return response()->json($response, 200);
        }
    }

    public function uploadQuestionStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'class_id' => 'required',
            'question_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response['isFailed'] = true;
            $response['status'] = 'empty';
            $response['message'] = 'Missing your data upload';

            return response()->json($response, 200);
        }

        return QuestionLogics::uploadQuestionStudent($request);
    }

    public function getComponent()
    {
        $school = (Auth::user()->customer->teacher->school) ? Auth::user()->customer->teacher->school : null;

        if ($school) {

            $groupParticipant = GroupParticipantQuestionTest::where('status', GlobalComponentCode::$TYPE_QUESTION['REGISTRATION'])
                ->where('school_id', $school->id)
                ->get();

            $class = StudentClass::where('school_group_id', $school->school_group_id)
                ->orWhere('school_id', $school->id);

            $department = Department::where('school_id', $school->id)->get();

            if ($groupParticipant && $class && $department) {

                $response['isFailed'] = false;
                $response['status'] = 'success';
                $response['message'] = 'success get data';
                $response['result'] = [
                    'class' => fractal($class, new BasicComponentTransformer()),
                    'department' => fractal($department, new BasicComponentTransformer()),
                    'groupParticipant' => fractal($groupParticipant, new BasicComponentTransformer()),
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

    public function getQuestionStudent(Request $request)
    {
        $teacherId = (Auth::user()->customer->teacher) ? Auth::user()->customer->teacher->id : null;

        if ($teacherId != null) {

            $searchClassId = !is_null($request->class_id) ? "AND `class_id` LIKE '%$request->class_id%'" : "";
            $searchDepartment = !is_null($request->department_id) ? "AND `department_id` LIKE '%$request->department_id%'" : "";
            $groupQuestionId = GlobalComponentCode::$GROUP_QUESTION['EXAM_STUDENT'];

            $getQuestion = DB::select("SELECT * FROM `questions` 
                WHERE `teacher_id` = '$teacherId' AND `group_question_id` = '$groupQuestionId' 
                $searchClassId $searchDepartment ORDER BY `created_at` DESC");

            if ($getQuestion) {

                $response['isFailed'] = false;
                $response['status'] = 'success';
                $response['message'] = 'Success get data question.js';
                $response['result'] = fractal($getQuestion, new ListQuestionTransformer());

                return response()->json($response, 200);
            } else {

                $response['isFailed'] = true;
                $response['status'] = 'null';
                $response['message'] = 'Question data that your get not found';

                return response()->json($response, 200);
            }
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'null';
            $response['message'] = 'teacher not listed';

            return response()->json($response, 200);
        }
    }

    public function getQuestionStudentDetail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_id' => 'required',
        ]);

        if ($validator->fails()) {

            $response['isFailed'] = true;
            $response['status'] = 'empty';
            $response['message'] = 'Missing question.js id required';

            return response()->json($response, 200);
        }

        $searchClassId = !is_null($request->class_id) ? "AND `class_id` LIKE '%$request->class_id%'" : "";
        $searchDepartment = !is_null($request->department_id) ? "AND `department_id` LIKE '%$request->department_id%'" : "";
        $searchGroupParticipant = !is_null($request->group_participant_id) ? "AND `group_participant_id` LIKE '%$request->group_participant_id%'" : "";

        $getQuestionTest = DB::select("SELECT * FROM `student_question_tests` 
            WHERE `question_id` = '$request->question_id' 
            $searchClassId $searchDepartment $searchGroupParticipant ORDER BY `created_at` DESC");

        if ($getQuestionTest) {

            $response['isFailed'] = false;
            $response['status'] = 'success';
            $response['message'] = 'Success get detail question.js test';
            $response['result'] = fractal($getQuestionTest, new ListQuestionTestTransformer());

            return response()->json($response, 200);
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'null';
            $response['message'] = 'Get question.js test detail failed';

            return response()->json($response, 200);
        }

    }

    public function questionStudentStatus(Request $request)
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

        return QuestionLogics::questionStudentStatus($request);
    }

}
