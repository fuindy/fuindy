<?php

namespace Fuindy\Repositories\School\v1\Transformers;

use Fuindy\Repositories\Components\v1\Models\Department;
use Fuindy\Repositories\Components\v1\Transformers\BasicComponentTransformer;
use Fuindy\Repositories\School\v1\Models\Question;
use League\Fractal\TransformerAbstract;

class ListQuestionTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Question $question)
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
                'department' => !is_null($question->school_id) ? $this->handleDepartment($question->school_id) : null
            ],
            'department' => [
                'id' => !is_null($question->department_id) ? $question->department_id : null,
                'name' => !is_null($question->department) ? $question->department->name : null
            ],
            'class' => [
                'id' => !is_null($question->class_id) ? $question->class_id : null,
                'name' => !is_null($question->class) ? $question->class->name : null
            ],
            'code' => !is_null($question->code) ? $question->code:null,
            'name' => !is_null($question->name) ? $question->name:null,
            'date_question' => !is_null($question->date_question) ? $question->date_question : null,
            'deadline' => !is_null($question->deadline) ? $question->deadline : null
        ];
    }

    private function handleDepartment($schoolId)
    {
        $department = Department::where('school_id', $schoolId)->get();

        if ($department) {
            return fractal($department, new BasicComponentTransformer());
        } else {
            return null;
        }
    }
}
