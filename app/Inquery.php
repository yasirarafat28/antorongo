<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inquery extends Model
{
    //
    protected $table = 'inquery';
    protected $primaryKey = 'id';


    public function user()
    {
        return $this->belongsTo('App\User','user_id');

    }


    public function receiver()
    {
        return $this->belongsTo('App\User','to_user_id');

    }

}
