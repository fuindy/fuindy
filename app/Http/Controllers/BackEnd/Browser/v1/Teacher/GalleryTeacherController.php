<?php

namespace Fuindy\Http\Controllers\BackEnd\Browser\v1\Teacher;

use Fuindy\Repositories\Gallery\v1\Logics\Visitors\GalleryCustomerLogic;
use Illuminate\Http\Request;
use Fuindy\Http\Controllers\Controller;

class GalleryTeacherController extends Controller
{
    public function listImage()
    {
        return GalleryCustomerLogic::listImage('student');
    }

    public function searchImage(Request $request)
    {
        return GalleryCustomerLogic::searchImage($request, 'student');
    }

    public function detailImage($id)
    {
        return GalleryCustomerLogic::detailImage($id);
    }
}
