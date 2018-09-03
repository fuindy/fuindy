<?php

namespace Fuindy\Http\Controllers\FrontEnd\v1\School;

use Illuminate\Http\Request;
use Fuindy\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function addSchool()
    {
        return view('pages.school.addSchool');
    }
}
