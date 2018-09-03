<?php

namespace Fuindy\Http\Controllers\BackEnd\Browser\v1\School;

use Fuindy\Repositories\Gallery\v1\Logics\Visitors\GallerySchoolLogic;
use Illuminate\Http\Request;
use Fuindy\Http\Controllers\Controller;

class GallerySchoolController extends Controller
{
    public function listImage()
    {
        return GallerySchoolLogic::listImage();
    }

    public function searchImage(Request $request)
    {
        return GallerySchoolLogic::searchImage($request);
    }

    public function detailImage($id)
    {
        return GallerySchoolLogic::detailImage($id);
    }
}
