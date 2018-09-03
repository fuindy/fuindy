<?php

namespace Fuindy\Repositories\Gallery\v1\Logics\Owners;

use Illuminate\Http\Request;

abstract class GallerySchoolUseCae
{
    public static function uploadImage(Request $request)
    {
        return (new static)->handleUploadImage($request);
    }

    abstract public function handleUploadImage($request);

    public static function listImage()
    {
        return (new static)->handleListImage();
    }

    abstract public function handleListImage();

    public static function searchImage(Request $request)
    {
        return (new static)->handleSearchImage($request);
    }

    abstract public function handleSearchImage($request);

    public static function detailImage($id)
    {
        return (new static)->handleDetailImage($id);
    }

    abstract public function handleDetailImage($id);

    public static function deleteDataUpload($id)
    {
        return (new static)->handleDeleteDataUpload($id);
    }

    abstract public function handleDeleteDataUpload($id);
}