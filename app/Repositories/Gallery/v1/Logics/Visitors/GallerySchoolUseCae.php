<?php

namespace Fuindy\Repositories\Gallery\v1\Logics\Visitors;

use Illuminate\Http\Request;

abstract class GallerySchoolUseCae
{
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
}