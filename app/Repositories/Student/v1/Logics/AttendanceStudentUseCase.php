<?php

namespace Fuindy\Repositories\Student\v1\Logics;

use Illuminate\Http\Request;

abstract class AttendanceStudentUseCase
{
    public static function createAttendance(Request $request)
    {
        return (new static)->handleCreateAttendance($request);
    }

    abstract public function handleCreateAttendance($request);

    public static function listStudent()
    {
        return (new static)->handleListStudent();
    }

    abstract public function handleListStudent();
}