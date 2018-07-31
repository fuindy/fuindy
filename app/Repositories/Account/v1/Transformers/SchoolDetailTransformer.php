<?php

namespace App\Repositories\Account\v1\Transformers;

use App\Repositories\School\v1\Models\School;
use League\Fractal\TransformerAbstract;

class SchoolDetailTransformer extends TransformerAbstract
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
            'school' => $this->handleSchool($school),
            'since' => !is_null($school->since) ? $school->since : '',
            'photo' => $this->handlePhoto($school),
            'amount' => $this->handleAmount($school)
        ];
    }

    private function handleSchool($school)
    {
        $data = [
            'group' => !is_null($school->group->school_group) ? $school->group->school_group : '',
            'name' => !is_null($school->school_name) ? $school->school_name : '',
            'address'=> !is_null($school->school_address) ? $school->school_address : ''
        ];

        return $data;
    }

    private function handlePhoto($school)
    {
        $data = [
            'profile' => !is_null($school->photo_profile) ? $school->photo_profile : '',
            'cover' => !is_null($school->photo_cover) ? $school->photo_cover : ''
        ];

        return $data;
    }

    private function handleAmount($school)
    {
        $data = [
            'department' => !is_null($school->amount_department) ? $school->amount_department : '',
            'student' => !is_null($school->amount_student) ? $school->amount_student : '',
            'teacher' => !is_null($school->amount_teacher) ? $school->amount_teacher : ''
        ];

        return $data;
    }
}
