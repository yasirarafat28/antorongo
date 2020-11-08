<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Saving;

class SavingTransaction extends Model
{
    //

    protected $table = 'saving_transaction';
    protected $primaryKey = 'id';


    public function savings()
    {
        return $this->belongsTo('App\Saving','saving_id');

    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id');

    }
    public function receiver()
    {
        return $this->belongsTo('App\User','received_by');

    }
}
