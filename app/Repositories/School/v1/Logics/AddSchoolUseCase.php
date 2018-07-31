<?php

namespace App\Repositories\School\v1\Logics;

use App\Http\Requests\v1\School\AddSchoolRequest;
use Illuminate\Http\Request;

abstract class AddSchoolUseCase
{
    public static function addSchool(AddSchoolRequest $request)
    {
        return (new static)->handleAddSchool($request);
    }

    abstract public function handleAddSchool($string);

    public static function addDepartment(Request $request)
    {
        return (new static)->handleAddDepartment($request);
    }

    abstract public function handleAddDepartment($request);

    public static function addPhoto(Request $request)
    {
        return (new static)->handleAddPhoto($request);
    }

    abstract public function handleAddPhoto($request);

    public static function addGallery(Request $request)
    {
        return (new static)->handleAddGallery($request);
    }

    abstract public function handleAddGallery($request);

}