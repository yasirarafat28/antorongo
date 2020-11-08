<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thana extends Model
{
    //
    protected $table = 'thana';
    protected $primaryKey = 'id';

    public function members()
    {
        return $this->hasMany('App\User','thana');

    }

}
