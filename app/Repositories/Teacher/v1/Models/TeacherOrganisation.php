<?php

namespace Fuindy\Repositories\Teacher\v1\Models;

use Fuindy\Repositories\Components\v1\Models\GroupOrganisationTeacher;
use Fuindy\Repositories\School\v1\Models\School;
use Illuminate\Database\Eloquent\Model;

class TeacherOrganisation extends Model
{
    protected $connection = 'customer';

    protected $table = 'teacher_organisations';

    protected $guarded = [''];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function groupOrganisation()
    {
        return $this->belongsTo(GroupOrganisationTeacher::class, 'group_organisation_teacher_id');
    }

}
