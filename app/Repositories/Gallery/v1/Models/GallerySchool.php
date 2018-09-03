<?php

namespace Fuindy\Repositories\Gallery\v1\Models;

use Fuindy\Repositories\School\v1\Models\School;
use Illuminate\Database\Eloquent\Model;

class GallerySchool extends Model
{
    protected $connection = 'customer';

    protected $table = 'gallery_schools';

    protected $guarded = [''];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }
}
