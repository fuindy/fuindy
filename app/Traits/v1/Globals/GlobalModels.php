<?php

namespace Fuindy\Traits\v1\Globals;

use Fuindy\Repositories\Components\v1\Models\Department;
use Fuindy\Repositories\Components\v1\Models\GroupCustomer;
use Fuindy\Repositories\Components\v1\Models\GroupSchool;
use Fuindy\Repositories\Components\v1\Models\Religion;

trait GlobalModels
{
    public function groupSchool()
    {
        $group = GroupSchool::all();

        return $group;
    }

    public function groupCustomer()
    {
        $group = GroupCustomer::all();

        return $group;
    }

    public function religion()
    {
        $religion = Religion::all();

        return $religion;
    }

    public function department()
    {
        $department = Department::all();

        return $department;
    }
}