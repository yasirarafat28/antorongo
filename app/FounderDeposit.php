<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FounderDeposit extends Model
{
    //

    public function user()
    {
        return $this->belongsTo('App\User','user_id');

    }

    public function balance(){
        $totalCreadit  = Transaction::whereIn('flag',['deposit','profit'])->where('transaction_for','founder_deposit')
            ->where('status','approved')->where('transactable_id',$this->id)->sum('amount');
        $totalDebit  = Transaction::whereIn('flag',['withdraw'])->where('transaction_for','founder_deposit')
        ->where('status','approved')->where('transactable_id',$this->id)->sum('amount');
        $balance = $totalCreadit-$totalDebit;
        return $balance;
    }



    public function histories(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','founder_deposit')->orderBy('date','DESC');
    }
    public function deposits(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','founder_deposit')->where('flag','deposit');
    }
    public function profits(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','founder_deposit')->where('flag','profit');
    }
    public function withdraws(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','founder_deposit')->where('flag','withdraw');
    }
}
