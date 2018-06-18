<?php

namespace App\Traits\v1\Globals;

use Faker\Provider\Uuid;

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
}