<?php

namespace App\Repositories\School\v1\Models;

use Illuminate\Database\Eloquent\Model;

class GallerySchool extends Model
{
    protected $table = 'gallery_schools';

    protected $fillable = ['school_id', 'gallery_school'];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }
}
