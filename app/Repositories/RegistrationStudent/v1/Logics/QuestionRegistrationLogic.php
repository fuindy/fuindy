<?php

namespace App\Repositories\RegistrationStudent\v1\Logics;

use App\Repositories\Components\v1\Models\HistoryQuestion;
use App\Repositories\RegistrationStudent\v1\Models\RegistrationQuestionTest;
use App\Repositories\RegistrationStudent\v1\Models\RegistrationQuestionTestDetail;
use App\Repositories\School\v1\Models\QuestionDetail;
use App\Traits\v1\Globals\GlobalComponentCode;
use App\Traits\v1\Globals\GlobalUtils;
use Illuminate\Support\Carbon;

class QuestionRegistrationLogic extends QuestionRegistrationUseCase
{
    use GlobalUtils;

    public function handleCheckAnswerRegistration($request)
    {
        $statusQuestion = RegistrationQuestionTest::find($request->question_test_id);

        if ($statusQuestion) {

            $statusQuestion->date_answer = Carbon::createFromFormat('d/m/Y', Carbon::now()->format('d/m/Y'));
            $statusQuestion->status = GlobalComponentCode::$STATUS_QUESTION_TEST['FINISH'];

            if ($statusQuestion->save()) {
                $questionAnswerDetail = '';
                $resultSuccess = '';
                $resultError = '';

//                $response['message'] = 'Thank you has been working on the question, your answer is being processed';

                for ($i = 0; $i < count($request->question_detail_id); $i++) {

                    $questionDetailId = $request->question_detail_id[$i];

                    $getAnswer = QuestionDetail::where('id', $questionDetailId)
                        ->where('question_id', $request->question_id)
                        ->first()
                        ->answer_true;

                    if ($getAnswer) {

                        $answer = ($getAnswer == $request->answer[$i]) ? 1 : 0;

                        $questionAnswerDetail = RegistrationQuestionTestDetail::create([
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
                        'participant_id' => $request->registration_id,
                        'type' => 'registration',
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
                $response['message'] = 'Your answer can\'t processed';

                return response()->json($response);
            }
        } else {

            $response['isFailed'] = true;
            $response['status'] = 'null';
            $response['message'] = 'Your answer can\'t processed';

            return response()->json($response);
        }
    }
}