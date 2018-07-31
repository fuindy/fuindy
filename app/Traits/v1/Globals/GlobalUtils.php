<?php

namespace App\Traits\v1\Globals;

use Faker\Provider\Uuid;
use Illuminate\Support\Facades\Auth;

trait GlobalUtils
{
    public function uuid()
    {
        return Uuid::uuid();
    }

    public function getFileName($file)
    {
        return str_random(32) . '.' . $file->extension();
    }

    public function getPhotoName($file, $text)
    {
        return str_random(20) . str_shuffle(str_replace(' ', '', $text)) . '.' . $file->extension();
    }

    private function getUserRequest()
    {
        if (!is_null(Auth::user())) { //from helpdesk
            return Auth::user();
        } else if (!is_null(Auth::guard('api')->user())) { //from API
            return Auth::guard('api')->user();
        } else {
            return null; //empty
        }
    }

}