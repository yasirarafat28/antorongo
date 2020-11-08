<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FdrTransaction extends Model
{
    //


    protected $table = 'fdr_transaction';
    protected $primaryKey = 'id';


    public function user()
    {
        return $this->belongsTo('App\User','user_id');

    }

    public function fdr()
    {
        return $this->belongsTo('App\Fdr','fdr_id');

    }

    public function receiver()
    {
        return $this->belongsTo('App\User','added_by');

    }
}
