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



    public function current_payable(){

        $total_give_away = $this->loan_give_away->sum('amount');
        $total_reveanue_paid = $this->paid_reveanues->sum('amount');
        $total_reveanue_added = $this->added_reveanues->sum('amount');

        $total_interest_added = $this->added_interests->sum('amount');
        $total_paid_interests = $this->interests->sum('amount');

        $total_waiver = $this->loan_waivers->sum('amount');

        $total_payable = $total_interest_added  +  $total_reveanue_added  +   $total_give_away - $total_reveanue_paid - $total_paid_interests -$total_waiver;
        return $total_payable;
    }
    public function histories(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','loan')->orderBy('date','DESC');
    }

    public function loan_give_away(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','loan')->where('flag','give_away');
    }
    public function added_reveanues(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','loan')->where('flag','revenue_add');
    }
    public function paid_reveanues(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','loan')->where('flag','revenue_deduct');
    }
    public function added_interests(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','loan')->where('flag','add_interest');
    }
    public function interests(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','loan')->where('flag','interest');
    }
    public function loan_waivers(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','loan')->where('flag','loan_waiver');
    }

}
