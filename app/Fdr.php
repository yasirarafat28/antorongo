<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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


    public function revenue_balance(){
        $totalCreadit  = Transaction::whereIn('flag',['deposit'])->where('transaction_for','fdr')
            ->where('status','approved')->where('transactable_id',$this->id)->sum('amount');
        $totalDebit  = Transaction::whereHas('head',function($q){
            $q->where('slug','fdr_refund_expense');
        })->whereIn('flag',['withdraw'])->where('transaction_for','fdr')
        ->where('status','approved')->where('transactable_id',$this->id)->sum('amount');
        $balance = $totalCreadit-$totalDebit;
        return $balance;
    }


    public function profit_balance(){
        $totalCreadit  = Transaction::whereIn('flag',['profit'])->where('transaction_for','fdr')
            ->where('status','approved')->where('transactable_id',$this->id)->sum('amount');
        $totalDebit  = Transaction::whereIn('flag',['withdraw'])->whereHas('head',function($q){
            $q->where('slug','fdr_profit_expense');
        })->where('transaction_for','fdr')
        ->where('status','approved')->where('transactable_id',$this->id)->sum('amount');
        $balance = $totalCreadit-$totalDebit;
        return $balance;
    }




    public function histories(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','fdr')->orderBy('date','DESC');
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

    public static function get_total_fdr_deposit_in_range($fdr_id,$from,$to){
        $from = date("Y-m-d", strtotime($from));
        $to = date("Y-m-d", strtotime($to));
        $tatal_fdr_diposit_amount = Transaction::where('transactable_id',$fdr_id)->where('transaction_for','fdr')->where('canculatable','yes')
        ->where(function($q) use($from,$to){
            if($from){
                $q->where(DB::raw('DATE(date)'),'>=',$from);
            }
            if($to){
                $q->where(DB::raw('DATE(date)'),'<=',$to);
            }
        })
        ->sum('amount');

        return  $tatal_fdr_diposit_amount;

    }

}
