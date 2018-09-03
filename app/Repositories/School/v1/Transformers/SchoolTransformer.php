<?php

namespace Fuindy\Repositories\School\v1\Transformers;

use Fuindy\Repositories\School\v1\Models\School;
use League\Fractal\TransformerAbstract;

class SchoolTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(School $school)
    {
        return [
            'id' => $school->id,
            'school' => $this->getSchool($school),
            'since' => !is_null($school->since) ? $school->since : '',
            'photo' => $this->getPhoto($school),
            'amount' => $this->getAmount($school),
            'descriptionSchool' => !is_null($school->description_school) ? $school->description_school : '',
        ];
    }

    private function getSchool($school)
    {
        $data = [
            'groupId' => !is_null($school->school_group_id) ? $school->school_group_id : '',
            'name' => !is_null($school->school_name) ? $school->school_name : '',
        ];

        return $data;
    }

    private function getPhoto($school)
    {
        $data = [
            'profile' => !is_null($school->photo_profile) ? $school->photo_profile : '',
            'cover' => !is_null($school->photo_cover) ? $school->photo_cover : ''
        ];

        return $data;
    }

    private function getAmount($school)
    {
        $data = [
            'department' => !is_null($school->amount_department) ? $school->amount_department : '',
            'student' => !is_null($school->amount_student) ? $school->amount_student : '',
            'teacher' => !is_null($school->amount_teacher) ? $school->amount_teacher : '',
        ];

        return $data;
    }
}
