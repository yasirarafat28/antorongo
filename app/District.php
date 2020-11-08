<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    //

    protected $table = 'district';
    protected $primaryKey = 'id';


    public function members()
    {
        return $this->hasMany('App\User','district');

    }

}
