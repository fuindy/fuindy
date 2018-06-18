<?php

namespace App\Http\Controllers\BackEnd\Browser\v1\School;

use App\Repositories\School\v1\Logics\QuestionLogics;
use App\Repositories\School\v1\Models\DetailQuestion;
use App\Repositories\School\v1\Models\Question;
use App\Traits\v1\Globals\GlobalUtils;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{

    public function __construct()
    {
//        $this->middleware('auth.school');
    }

    public function addQuestion(Request $request)
    {
        return QuestionLogics::addQuestion($request);
    }
}
