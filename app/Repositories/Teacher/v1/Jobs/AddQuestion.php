<?php

namespace Fuindy\Repositories\Teacher\v1\Jobs;

use Fuindy\Repositories\School\v1\Models\Question;
use Fuindy\Repositories\School\v1\Models\QuestionDetail;
use Fuindy\Repositories\Teacher\v1\Models\Teacher;
use Fuindy\Traits\v1\Globals\GlobalComponentCode;
use Fuindy\Traits\v1\Globals\GlobalUtils;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AddQuestion implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use GlobalUtils;

    public $request;
    public $teacher;
    public $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request, $teacher, $user)
    {
        $this->request = $request;
        $this->teacher = $teacher;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $teacher = Teacher::find($this->teacher);

        $createQuestion = Question::create([
            'id' => $this->uuid(),
            'group_question_id' => $this->request->group_question_id,
            'type_question_id' => $this->request->type_question_id,
            'school_id' => $teacher->school_id,
            'teacher_id' => $teacher->id,
            'code' => rand(123456789, 999999999),
            'name' => $this->request->name,
            'date_question' => $this->request->date_question,
            'deadline' => $this->request->dealine,
        ]);

        if ($createQuestion) {

            for ($i = 0; $i < count($this->request->contents); $i++) {

                QuestionDetail::create([
                    'id' => $this->uuid(),
                    'question_id' => $createQuestion->id,
                    'content' => $this->request[$i]->contents,
                    'answer_a' => $this->request[$i]->answer_a,
                    'answer_b' => $this->request[$i]->answer_b,
                    'answer_c' => $this->request[$i]->answer_c,
                    'answer_d' => $this->request[$i]->answer_d,
                    'answer_e' => $this->request[$i]->answer_e,
                    'answer_true' => $this->request[$i]->answer_true
                ]);

            }

        }
    }
}
