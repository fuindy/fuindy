<?php

namespace Fuindy\Repositories\Account\v1\Models;

use Fuindy\Repositories\School\v1\Models\School;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements CanResetPassword
{
    use Notifiable;
    use HasRoles;
    use HasApiTokens;

    protected $connection = 'customer';

    protected $table = 'users';

    public $incrementing = false;

    protected $guarded = [''];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // for login api //
    public function findForPassport($username)
    {
        return $this->orWhere('email', $username)->orWhere('name', $username)->first();
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
