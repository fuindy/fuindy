<?php

namespace Fuindy\Repositories\Components\v1\Models;

use Illuminate\Database\Eloquent\Model;

class GroupOrganisationClass extends Model
{
    protected $connection = 'customer';

    protected $table = 'group_organisation_classes';

    protected $guarded = [''];
}
