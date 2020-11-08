<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fdr extends Model
{
    //

    protected $table = 'fdr';
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo('App\User','user_id');

    }

    public function receiver()
    {
        return $this->belongsTo('App\User','added_by');

    }


    public function transactions()
    {
        return $this->hasMany('App\FdrTransaction','fdr_id');

    }

}
