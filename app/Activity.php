<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

    protected $table = 'activity_log';
    protected $primaryKey = 'id';



    public function user()
    {
        return $this->belongsTo('App\User','user_id');

    }
}
