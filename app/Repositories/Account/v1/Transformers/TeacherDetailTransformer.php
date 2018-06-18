<?php

namespace App\Repositories\Account\v1\Transformers;

use App\Repositories\Teacher\v1\Models\Teacher;
use League\Fractal\TransformerAbstract;

class TeacherDetailTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Teacher $teacher)
    {
        return [
            'id' => $teacher->id,
            'customerId' => $teacher->customer_id,
            'religion' =>!is_null($teacher->religion) ? $teacher->religion->religion : '',
            'fullName' => !is_null($teacher->full_name) ? $teacher->full_name : '',
            'teachField' => !is_null($teacher->teach_field) ? $teacher->teach_field : '',
            'address' => !is_null($teacher->address) ? $teacher->address : '',
            'placeOfBirth' => !is_null($teacher->place_of_birth) ? $teacher->place_of_birth : '',
            'dateOfBirth' => !is_null($teacher->date_of_birth) ? $teacher->date_of_birth : '',
            'loginTeaching' => !is_null($teacher->long_teaching) ? $teacher->long_teaching : '',
            'status' => !is_null($teacher->status->status_teacher) ? $teacher->status->status_teacher : '',
            'photo' => $this->handlePhoto($teacher)
        ];
    }

    private function handlePhoto($teacher)
    {
        $data = [
            'profile' => !is_null($teacher->photo_profile) ? $teacher->photo_profile : '',
            'cover' =>!is_null($teacher->photo_cover) ? $teacher->photo_cover : ''
        ];

        return $data;
    }
}
