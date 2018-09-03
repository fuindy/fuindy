<?php

namespace Fuindy\Repositories\Student\v1\Jobs;

use Fuindy\Repositories\Components\v1\Models\HistoryQuestion;
use Fuindy\Repositories\School\v1\Models\QuestionDetail;
use Fuindy\Repositories\Student\v1\Models\StudentQuestionTest;
use Fuindy\Repositories\Student\v1\Models\StudentQuestionTestDetail;
use Fuindy\Traits\v1\Globals\GlobalComponentCode;
use Fuindy\Traits\v1\Globals\GlobalUtils;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Carbon;

class AnswerQuestion implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use GlobalUtils;

    public $request;
    public $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request, $user)
    {
        $this->request = $request;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $statusQuestion = StudentQuestionTest::find($this->request->question_test_id);

        if ($statusQuestion) {

            $statusQuestion->date_answer = Carbon::createFromFormat('d/m/Y', Carbon::now()->format('d/m/Y'));
            $statusQuestion->status = GlobalComponentCode::$STATUS_QUESTION_TEST['FINISH'];

            if ($statusQuestion->save()) {
                $questionAnswerDetail = '';
                $resultSuccess = '';
                $resultError = '';

//                $response['message'] = 'Thank you has been working on the question, your answer is being processed';

                for ($i = 0; $i < count($this->request->question_detail_id); $i++) {

                    $questionDetailId = $this->request->question_detail_id[$i];

                    $getAnswer = QuestionDetail::where('id', $questionDetailId)
                        ->where('question_id', $this->request->question_id)
                        ->first()
                        ->answer_true;

                    if ($getAnswer) {

                        $answer = ($getAnswer == $this->request->answer[$i]) ? 1 : 0;

                        $questionAnswerDetail = StudentQuestionTestDetail::create([
                            'id' => $this->uuid(),
                            'question_detail_id' => $questionDetailId,
                            'question_test_id' => $this->request->question_test_id,
                            'answer' => $this->request->answer[$i],
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

                    HistoryQuestion::create([
                        'question_id' => $this->request->question_test_id,
                        'school_id' => $this->request->school_id,
                        'participant_id' => $this->request->student_id,
                        'type' => 'student',
                        'processing_time' => $this->request->processing_time,
                        'success' => count($resultSuccess),
                        'error' => count($resultError)
                    ]);
                }
            }
        }
    }
}
