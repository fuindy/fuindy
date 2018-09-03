<?php

namespace Fuindy\Repositories\School\v1\Transformers;

use Fuindy\Repositories\Components\v1\Models\Department;
use Fuindy\Repositories\Components\v1\Transformers\BasicComponentTransformer;
use Fuindy\Repositories\School\v1\Models\Question;
use Fuindy\Repositories\Student\v1\Models\StudentQuestionTest;
use Fuindy\Repositories\Student\v1\Models\StudentQuestionTestDetail;
use League\Fractal\TransformerAbstract;

class ListQuestionTestTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(StudentQuestionTest $question)
    {
        return [
            'id' => $question->id,
            'groupQuestion' => [
                'id' => !is_null($question->group_question_id) ? $question->group_question_id : null,
                'name' => !is_null($question->group) ? $question->group->name : null
            ],
            'typeQuestion' => [
                'id' => !is_null($question->type_question_id) ? $question->type_question_id : null,
                'name' => !is_null($question->type) ? $question->type->name : null
            ],
            'school' => [
                'id' => !is_null($question->school_id) ? $question->school_id : null,
                'name' => !is_null($question->school) ? $question->school->school_name : null,
                'group' => !is_null($question->school->school_group_id) ? $question->school->school_group_id : null,
            ],
            'student' => [
                'id' => !is_null($question->student_id) ? $question->student_id : null,
                'name' => !is_null($question->student) ? $question->student->full_name : null,
                'score' => !is_null($question->id) ? $this->handletoTalScore($question->id) : null
            ],
            'department' => [
                'id' => !is_null($question->department_id) ? $question->department_id : null,
                'name' => !is_null($question->department) ? $question->department->name : null
            ],
            'class' => [
                'id' => !is_null($question->class_id) ? $question->class_id : null,
                'name' => !is_null($question->class) ? $question->class->name : null
            ],
            'question.js' => [
                'id' => !is_null($question->question_id) ? $question->question_id : null,
                'name' => !is_null($question->question) ? $question->question->name : null,
                'code' => !is_null($question->question) ? $question->question->code : null,
                'date' => !is_null($question->question) ? $question->question->date_question : null,
            ],
            'dateAnswer' => !is_null($question->date_answer) ? $question->date_answer : null,
            'deadline' => !is_null($question->deadline) ? $question->deadline : null
        ];
    }

    private function handleTotalScore($questionTestId)
    {
        $countAnswerTrue = StudentQuestionTestDetail::where('question_test_id', $questionTestId)
            ->where('result_answer', '!=', 0)
            ->count();

        if ($countAnswerTrue) {

            $countAllAnswer = StudentQuestionTestDetail::where('question_test_id', $questionTestId)->count();

            $totalScore = round($countAnswerTrue * (100 / $countAllAnswer), 2);
        } else {
            $totalScore = null;
        }

        return $totalScore;
    }
}
