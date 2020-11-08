<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanTransaction extends Model
{
    //
    protected $table = 'loan_transaction';
    protected $primaryKey = 'id';


    public function user()
    {
        return $this->belongsTo('App\User','user_id');

    }
    public function receiver()
    {
        return $this->belongsTo('App\User','received_by');

    }

    public function loans()
    {
        return $this->belongsTo('App\Loan','loan_id');

    }
}
