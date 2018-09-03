<?php

namespace Fuindy\Repositories\Gallery\v1\Models;

use Illuminate\Database\Eloquent\Model;

class GallerySchoolFile extends Model
{
    protected $connection = 'customer';

    protected $table = 'gallery_school_files';

    protected $guarded = [''];

    public function gallery()
    {
        return $this->belongsTo(GallerySchool::class, 'gallery_id');
    }
}
