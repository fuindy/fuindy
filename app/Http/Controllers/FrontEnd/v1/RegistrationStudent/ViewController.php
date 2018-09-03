<?php

namespace Fuindy\Http\Controllers\FrontEnd\v1\RegistrationStudent;

use Fuindy\Repositories\RegistrationStudent\v1\Models\RegistrationDate;
use Fuindy\Repositories\School\v1\Models\School;
use Fuindy\Traits\v1\Globals\GlobalModels;
use Illuminate\Http\Request;
use Fuindy\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class ViewController extends Controller
{
    use GlobalModels;

    public function index()
    {
        return view('pages.registrationStudent.registration');
    }
}
