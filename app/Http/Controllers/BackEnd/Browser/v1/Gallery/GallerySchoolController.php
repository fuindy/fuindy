<?php

namespace Fuindy\Http\Controllers\BackEnd\Browser\v1\Gallery;

use Fuindy\Repositories\Gallery\v1\Logics\Owners\GallerySchoolLogic;
use Illuminate\Http\Request;
use Fuindy\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class GallerySchoolController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth.access');
    }

    public function uploadImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fileImage' => 'required',
        ]);

        if ($validator->fails()) {

            $response['isFailed'] = true;
            $response['status'] = 'empty';
            $response['message'] = 'File image is empty..!!';

            return response()->json($response, 200);
        }

        return GallerySchoolLogic::uploadImage($request);
    }

    public function listImage()
    {
        return GallerySchoolLogic::listImage();
    }

    public function searchImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search' => 'required',
        ]);

        if ($validator->fails()) {

            $response['isFailed'] = true;
            $response['status'] = 'empty';
            $response['message'] = 'Data request search empty';

            return response()->json($response, 200);
        }

        return GallerySchoolLogic::searchImage($request);
    }

    public function detailImage($id)
    {
        return GallerySchoolLogic::detailImage($id);
    }

    public function deleteDataUpload($id)
    {
        return GallerySchoolLogic::deleteDataUpload($id);
    }
}
