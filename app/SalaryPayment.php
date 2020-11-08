<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryPayment extends Model
{
    //


    protected $table = 'salary_payment';
    protected $primaryKey = 'id';


    public function user()
    {
        return $this->belongsTo('App\User','user_id');

    }
}
