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


    public function histories(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','loan');
    }

    public function loan_give_away(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','loan')->where('flag','give_away');
    }
    public function added_reveanues(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','loan')->where('flag','revenue_add');
    }
    public function interests(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','loan')->where('flag','interest');
    }
    public function paid_reveanues(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','loan')->where('flag','revenue_deduct');
    }

}
