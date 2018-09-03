<?php

namespace Fuindy\Repositories\Account\v1\Transformers;

use Fuindy\Repositories\Student\v1\Models\Student;
use League\Fractal\TransformerAbstract;

class StudentDetailTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Student $student)
    {
        return [
            'id' => $student->id,
            'customerId' => $student->customer_id,
            'department' => !is_null($student->department) ? $student->department->department_name : '',
            'class' => !is_null($student->class) ? $student->class->class_name : '',
            'religion' => !is_null($student->religion) ? $student->religion->religion : '',
            'birth' => $this->handleBirth($student),
            'hobby' => !is_null($student->hobby) ? $student->hobby : '',
            'purpose' => !is_null($student->purpose) ? $student->purpose : '',
            'address' => !is_null($student->address) ? $student->address : '',
            'stayWith' => !is_null($student->stay_with) ? $student->stay_with : '',
            'distanceSchool' => !is_null($student->distance_to_school) ? $student->distance_to_school : '',
            'photo' => $this->handlePhoto($student),
            'father' => $this->handleFather($student),
            'mother' => $this->handleMother($student),
            'trustee' => $this->handleTrustee($student),
            'status' => !is_null($student->status) ? $student->status->status_student : ''
        ];
    }

    private function handleBirth($student)
    {
        $data = [
            'place' => !is_null($student->place_of_birth) ? $student->place_of_birth : '',
            'date' => !is_null($student->date_of_birth) ? $student->date_of_birth : ''
        ];

        return $data;
    }

    private function handlePhoto($student)
    {
        $data = [
            'profile' => !is_null($student->photo_profile) ? $student->photo_profile : '',
            'cover' => !is_null($student->photo_cover) ? $student->photo_cover : ''
        ];

        return $data;
    }

    private function handleFather($student)
    {
        $data = [
            'name' => !is_null($student->father_name) ? $student->father_name : '',
            'occupation' => !is_null($student->father_occupation) ? $student->father_occupation : '',
            'placeBirth' => !is_null($student->father_place_birth) ? $student->father_place_birth : '',
            'dateBirth' => !is_null($student->father_date_birth) ? $student->father_date_birth : '',
            'income' => !is_null($student->father_income) ? $student->father_income : ''
        ];

        return $data;
    }

    private function handleMother($student)
    {
        $data = [
            'name' => !is_null($student->mother_name) ? $student->mother_name : '',
            'occupation' => !is_null($student->mother_occupation) ? $student->mother_occupation : '',
            'placeBirth' => !is_null($student->mother_place_birth) ? $student->mother_place_birth : '',
            'dateBirth' => !is_null($student->mother_date_birth) ? $student->mother_date_birth : '',
            'income' => !is_null($student->mother_income) ? $student->mother_income : ''
        ];

        return $data;
    }

    private function handleTrustee($student)
    {
        $data = [
            'name' => !is_null($student->trustee_name) ? $student->trustee_name : '',
            'occupation' => !is_null($student->trustee_occupation) ? $student->trustee_occupation : '',
            'placeBirth' => !is_null($student->trustee_place_birth) ? $student->trustee_place_birth : '',
            'dateBirth' => !is_null($student->trustee_date_birth) ? $student->trustee_date_birth : '',
            'income' => !is_null($student->trustee_income) ? $student->trustee_income : ''
        ];

        return $data;
    }
}
