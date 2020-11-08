<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    //

    protected $table = 'saving';
    protected $primaryKey = 'id';


    public function user()
    {
        return $this->belongsTo('App\User','user_id');

    }


    public function package()
    {
        return $this->belongsTo('App\SavingPackage','package_id');

    }

    public function identifier()
    {
        return $this->belongsTo('App\User','identifier_id');

    }
}
