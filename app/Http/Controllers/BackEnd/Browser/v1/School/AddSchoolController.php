<?php

namespace App\Http\Controllers\BackEnd\Browser\v1\School;

use App\Http\Requests\v1\School\AddSchoolRequest;
use App\Repositories\School\v1\Logics\AddSchoolLogic;
use App\Traits\v1\Globals\GlobalUtils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddSchoolController extends Controller
{
    use GlobalUtils;

    public function addSchool(AddSchoolRequest $request)
    {
        return AddSchoolLogic::addSchool($request);
    }

    public function addDepartment(Request $request)
    {
        return AddSchoolLogic::addDepartment($request);
    }

    public function addPhoto(Request $request)
    {
        return AddSchoolLogic::addPhoto($request);
    }

    public function addGallery(Request $request)
    {
        return AddSchoolLogic::addGallery($request);
    }
}
