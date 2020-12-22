<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','status','unique_id','role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function totalLoan()
    {
        return $this->hasMany('App\Loan','user_id');

    }

    public function totalFdr()
    {
        return $this->hasMany('App\Fdr','user_id');

    }

    public function totalSaving()
    {
        return $this->hasMany('App\Saving','user_id');

    }

    public function sub_members(){
        return $this->hasMany('App\User','parent_id');
    }


}
