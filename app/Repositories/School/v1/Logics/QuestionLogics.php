<?php

namespace App\Repositories\School\v1\Logics;

use App\Http\Controllers\BackEnd\Browser\v1\Traits\Config;
use App\Repositories\Account\v1\Models\User;
use App\Repositories\Components\v1\Models\Department;
use App\Repositories\Components\v1\Transformers\DepartmentTransformer;
use App\Repositories\School\v1\Logics\AddSchoolUseCase;
use App\Repositories\School\v1\Models\DetailQuestion;
use App\Repositories\School\v1\Models\GallerySchool;
use App\Repositories\School\v1\Models\Question;
use App\Repositories\School\v1\Models\School;
use App\Traits\v1\Globals\GlobalUtils;
use App\Repositories\School\v1\Transformers\SchoolTransformer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuestionLogics extends QuestionUseCase
{
    use GlobalUtils;

    public function handleAddQuestion($request)
    {
        $validator = Validator::make($request->all(), [
            'group_question_id' => 'required',
            'type_question_id' => 'required',
            'date_question' => 'required|date_format:d/m/Y',
            'contents' => 'required',
            'answer_a' => 'required',
            'answer_b' => 'required',
            'answer_c' => 'required',
            'answer_d' => 'required',
            'answer_e' => 'required',
        ]);

        if ($validator->fails()) {
            $response['status'] = 'error';
            $response['message'] = 'Missing required question';

            return response()->json($response, 200);
        }

        $createQuestion = Question::create([
            'id' => $this->uuid(),
            'group_question_id' => $request->group_question_id,
            'type_question_id' => $request->type_question_id,
            'school_id' => Auth::user()->school_id,
            'code' => rand(123456789, 999999999),
            'date_question' => $request->date_question,
        ]);

        if ($createQuestion) {

            $createDetailQuestion = '';
            $resultQuestionSuccess = [];
            $resultQuestionFailed = [];

            for ($i = 0; $i < count($request->contents); $i++) {

                $createDetailQuestion = DetailQuestion::create([
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
                $response['status'] = 'error';
                $response['message'] = 'Create Question success';
                $response['result'] = [
                    'success' => $resultQuestionSuccess,
                    'failed' => $resultQuestionFailed
                ];
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Create Question failed';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Can\'t create question';
        }

        return response()->json($response, 200);
    }
}