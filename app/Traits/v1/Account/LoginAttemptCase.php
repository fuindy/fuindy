<?php

namespace App\Traits\v1\Account;

use App\Traits\v1\Globals\GlobalUtils;
use Illuminate\Support\Facades\Auth;

trait LoginAttemptCase
{
    use GlobalUtils;

    /* Default value */
    public $guest = true;
    public $noAccess = false;
    public $admin = false;
    public $school = false;
    public $student = false;
    public $teacher = false;

    public function logicCase($guard)
    {
        if (!empty(Auth::guard($guard)) && !empty(Auth::guard($guard)->user())) {

            $this->noAccess = !Auth::guard($guard)->user()->status_active_id;

            $this->admin = Auth::guard($guard)->user()->admin_access;

            $this->school = Auth::guard($guard)->user()->school_access;

            $this->student = Auth::guard($guard)->user()->student_access;

            $this->teacher = Auth::guard($guard)->user()->teacher_access;
        }

    }
}