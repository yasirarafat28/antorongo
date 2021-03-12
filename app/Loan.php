<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function get_total_loan_in_range($loan_id,$from,$to){
        $from = date("Y-m-d", strtotime($from));
        $to = date("Y-m-d", strtotime($to));
        $tatal_give_away_amount = Transaction::where('transactable_id',$loan_id)->where('transaction_for','loan')->where('flag','give_away')->where('canculatable','yes')
        ->where(function($q) use($from,$to){
            if($from){
                $q->where(DB::raw('DATE(date)'),'>=',$from);
            }
            if($to){
                $q->where(DB::raw('DATE(date)'),'<=',$to);
            }
        })
        ->sum('amount');

        $tatal_added_reveanues_amount = Transaction::where('transactable_id',$loan_id)->where('transaction_for','loan')->where('flag','revenue_add')->where('canculatable','yes')
        ->where(function($q) use($from,$to){
            if($from){
                $q->where(DB::raw('DATE(date)'),'>=',$from);
            }
            if($to){
                $q->where(DB::raw('DATE(date)'),'<=',$to);
            }
        })
        ->sum('amount');

        $tatal_paid_reveanues_amount = Transaction::where('transactable_id',$loan_id)->where('transaction_for','loan')->where('flag','revenue_deduct')->where('canculatable','yes')
        ->where(function($q) use($from,$to){
            if($from){
                $q->where(DB::raw('DATE(date)'),'>=',$from);
            }
            if($to){
                $q->where(DB::raw('DATE(date)'),'<=',$to);
            }
        })
        ->sum('amount');

         $total_loan = $tatal_give_away_amount + $tatal_added_reveanues_amount - $tatal_paid_reveanues_amount;

         return $total_loan;



    }

    public static function get_total_interest_in_range($loan_id,$from,$to){

        $tatal_addinterest_amount = Transaction::where('transactable_id',$loan_id)->where('transaction_for','loan')->where('flag','add_interest')->where('canculatable','yes')
        ->where(function($q) use($from,$to){
            if($from){
                $q->where(DB::raw('DATE(date)'),'>=',$from);
            }
            if($to){
                $q->where(DB::raw('DATE(date)'),'<=',$to);
            }
        })
        ->sum('amount');

        $tatal_interest_amount = Transaction::where('transactable_id',$loan_id)->where('transaction_for','loan')->where('flag','interest')->where('canculatable','yes')
        ->where(function($q) use($from,$to){
            if($from){
                $q->where(DB::raw('DATE(date)'),'>=',$from);
            }
            if($to){
                $q->where(DB::raw('DATE(date)'),'<=',$to);
            }
        })
        ->sum('amount');

        $total_interest = $tatal_addinterest_amount - $tatal_interest_amount;

        return $total_interest;

    }

}
