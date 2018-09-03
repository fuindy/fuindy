<?php

namespace Fuindy\Repositories\Components\v1\Models;

use Illuminate\Database\Eloquent\Model;

class GroupOrganisationTeacher extends Model
{
    protected $connection = 'customer';

    protected $table = 'group_organisation_teachers';

    protected $guarded = [''];
}
