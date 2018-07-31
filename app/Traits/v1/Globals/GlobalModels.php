<?php

namespace App\Traits\v1\Globals;

use App\Repositories\Components\v1\Models\Department;
use App\Repositories\Components\v1\Models\GroupCustomer;
use App\Repositories\Components\v1\Models\GroupSchool;
use App\Repositories\Components\v1\Models\Religion;

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