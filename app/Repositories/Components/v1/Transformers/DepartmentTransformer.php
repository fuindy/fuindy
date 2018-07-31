<?php

namespace App\Repositories\Components\v1\Transformers;

use App\Repositories\Components\v1\Models\Department;
use League\Fractal\TransformerAbstract;

class DepartmentTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Department $department)
    {
        return [
            'id' => $department->id,
            'schoolId' => $department->school_id,
            'name' => $department->name,
            'descriptionDepartment' => $department->description_department
        ];
    }
}
