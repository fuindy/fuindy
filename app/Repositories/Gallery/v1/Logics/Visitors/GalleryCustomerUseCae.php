<?php

namespace Fuindy\Repositories\Gallery\v1\Logics\Visitors;

use Illuminate\Http\Request;

abstract class GalleryCustomerUseCae
{
    public static function listImage($type)
    {
        return (new static)->handleListImage($type);
    }

    abstract public function handleListImage($type);

    public static function searchImage(Request $request, $type)
    {
        return (new static)->handleSearchImage($request, $type);
    }

    abstract public function handleSearchImage($request, $type);

    public static function detailImage($id)
    {
        return (new static)->handleDetailImage($id);
    }

    abstract public function handleDetailImage($id);

}