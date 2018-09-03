<?php

namespace Fuindy\Http\Controllers\BackEnd\Browser\v1\School;

use Fuindy\Http\Requests\v1\School\AddSchoolRequest;
use Fuindy\Repositories\School\v1\Logics\AddSchoolLogic;
use Fuindy\Traits\v1\Globals\GlobalUtils;
use Fuindy\Http\Controllers\Controller;
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
