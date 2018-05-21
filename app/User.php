<?php

namespace App;

use App\Model\Customer\tbl_access;
use App\Model\Customer\tbl_customer;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'id_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_school', 'id_customer', 'id_access', 'name', 'full_name', 'email', 'password', 'id_status_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function customer()
    {
        return $this->belongsTo(tbl_customer::class, 'id_customer');
    }

    public function access()
    {
        return $this->belongsTo(tbl_access::class, 'id_access');
    }
}
