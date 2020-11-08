<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalarySetup extends Model
{
    //

    protected $table = 'salary_setup';
    protected $primaryKey = 'id';


    public function user()
    {
        return $this->belongsTo('App\User','user_id');

    }
}
