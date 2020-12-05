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


    // public function transactions()
    // {
    //     return $this->hasMany('App\FdrTransaction','fdr_id');

    // }

    public function balance(){
        $totalCreadit  = Transaction::whereIn('flag',['deposit','profit'])->where('transaction_for','fdr')
            ->where('status','approved')->where('transactable_id',$this->id)->sum('amount');
        $totalDebit  = Transaction::whereIn('flag',['withdraw'])->where('transaction_for','fdr')
        ->where('status','approved')->where('transactable_id',$this->id)->sum('amount');
        $balance = $totalCreadit-$totalDebit;
        return $balance;
    }


    public function profit_balance(){
        $totalCreadit  = Transaction::whereIn('flag',['profit'])->where('transaction_for','fdr')
            ->where('status','approved')->where('transactable_id',$this->id)->sum('amount');
        $totalDebit  = Transaction::whereIn('flag',['withdraw'])->where('transaction_for','fdr')
        ->where('status','approved')->where('transactable_id',$this->id)->sum('amount');
        $balance = $totalCreadit-$totalDebit;
        return $balance;
    }




    public function histories(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','fdr');
    }
    public function deposits(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','fdr')->where('flag','deposit');
    }
    public function profits(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','fdr')->where('flag','profit');
    }
    public function withdraws(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','fdr')->where('flag','withdraw');
    }

}
