<?php

namespace App\Repositories\School\v1\Transformers;

use App\Repositories\Components\v1\Models\Department;
use App\Repositories\Components\v1\Transformers\BasicComponentTransformer;
use App\Repositories\RegistrationStudent\v1\Models\MessageRegistration;
use App\Repositories\Student\v1\Models\StudentClass;
use League\Fractal\TransformerAbstract;

class RegistrationStudentTransformation extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(MessageRegistration $registration)
    {
        return [
            'registrationStudentId' => $registration->registration_student_id,
            'statusRegistration' => !is_null($registration->registration) ? $registration->registration->status_registration_id : "",
            'groupSchool' => !is_null($registration->school->group) ? $registration->school->group->id : "",
            'department' => ($registration->school->school_group_id == 5 || $registration->school->school_group_id == 6) ? $this->handleDepartment($registration->school) : "",
            'class' => !is_null($registration->school->group) ? $this->handleClass($registration->school->group->id) : ""
        ];
    }

    private function handleDepartment($school)
    {
        $department = Department::where('school_id', $school->id)->get();

        if ($department) {
            $result = fractal($department, new BasicComponentTransformer());
        } else {
            $result = [];
        }

        return $result;
    }

    private function handleClass($id)
    {
        $class = StudentClass::where('school_group_id', $id)->get();

        if ($class) {
            $result = fractal($class, new BasicComponentTransformer());
        } else {
            $result = [];
        }

        return $result;
    }

}
