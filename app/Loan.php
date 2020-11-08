<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    //

    protected $table = 'loan';
    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo('App\User','user_id');

    }

    public function PersonDepositors()
    {
        return $this->hasMany('App\DepositoryMember','loan_id');

    }

    public function PropertyDepositors()
    {
        return $this->hasMany('App\DepositoryProperty','loan_id');

    }

    public function OrnamentDepositors()
    {
        return $this->hasMany('App\DepositoryOrnament','loan_id');

    }

    public function transactions()
    {
        return $this->hasMany('App\LoanTransaction','loan_id');

    }
}
