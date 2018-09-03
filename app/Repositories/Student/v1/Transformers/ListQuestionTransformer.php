<?php

namespace Fuindy\Repositories\Student\v1\Transformers;

use Fuindy\Repositories\School\v1\Models\QuestionDetail;
use Fuindy\Repositories\Student\v1\Models\StudentQuestionTest;
use League\Fractal\TransformerAbstract;

class ListQuestionTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(StudentQuestionTest $questionTest)
    {
        return [
            'school' => [
                'id' => $questionTest->school_id,
                'name' => is_null($questionTest->school) ? $questionTest->school->school_name : ''
            ],
            'student' => [
                'id' => $questionTest->student_id,
                'name' => is_null($questionTest->student) ? $questionTest->student->full_name : ''
            ],
            'class' => [
                'id' => $questionTest->class_id,
                'name' => is_null($questionTest->class) ? $questionTest->class->name : ''
            ],
            'department' => [
                'id' => $questionTest->department_id,
                'name' => is_null($questionTest->department) ? $questionTest->department->name : ''
            ],
            'groupParticipant' => [
                'id' => $questionTest->group_participant_id,
                'name' => is_null($questionTest->groupParticipant) ? $questionTest->groupParticipant->name : ''
            ],
            'question.js' => [
                'testId' => $questionTest->id,
                'id' => $questionTest->question_id,
                'type' => !is_null($questionTest->question->type) ? $questionTest->question->type->name : '',
                'group' => !is_null($questionTest->question->group) ? $questionTest->question->group->name : '',
                'date' => !is_null($questionTest->question) ? $questionTest->question->date_question : '',
            ],
        ];
    }
}
