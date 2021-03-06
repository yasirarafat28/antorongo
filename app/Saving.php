<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Saving extends Model
{
    //

    protected $table = 'saving';
    protected $primaryKey = 'id';


    public function user()
    {
        return $this->belongsTo('App\User','user_id');

    }


    public function package()
    {
        return $this->belongsTo('App\SavingPackage','package_id');

    }

    public function identifier()
    {
        return $this->belongsTo('App\User','identifier_id');

    }

    public function balance(){

        $totalCreadit  = Transaction::whereIn('flag',['deposit','profit'])->where('transaction_for','saving')
            ->where('status','approved')->where('transactable_id',$this->id)->sum('amount');
        $totalDebit  = Transaction::whereIn('flag',['withdraw'])->where('transaction_for','saving')
        ->where('status','approved')->where('transactable_id',$this->id)->sum('amount');

        $balance = $totalCreadit-$totalDebit;
        return $balance;

    }


    public function deposit_balance(){

        $totalCreadit  = Transaction::whereIn('flag',['deposit'])->where('transaction_for','saving')
            ->where('status','approved')->where('transactable_id',$this->id)->sum('amount');
        $totalDebit  = Transaction::whereIn('flag',['deposit_withdraw'])->where('transaction_for','saving')
        ->where('status','approved')->where('transactable_id',$this->id)->sum('amount');

        $balance = $totalCreadit-$totalDebit;
        return $balance;
    }

    public function profit_balance(){

        $totalCreadit  = Transaction::whereIn('flag',['profit'])->where('transaction_for','saving')
            ->where('status','approved')->where('transactable_id',$this->id)->sum('amount');
        $totalDebit  = Transaction::whereIn('flag',['profit_withdraw'])->where('transaction_for','saving')
        ->where('status','approved')->where('transactable_id',$this->id)->sum('amount');

        $balance = $totalCreadit-$totalDebit;
        return $balance;
    }


    public function histories(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','saving')->orderBy('date','DESC');
    }
    public function deposits(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','saving')->where('flag','deposit');
    }
    public function profits(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','saving')->where('flag','profit');
    }
    public function withdraws(){
        return $this->hasMany('App\Transaction','transactable_id')->where('transaction_for','saving')->whereIn('flag',['profit_withdraw','deposit_withdraw']);
    }

    public function groupped_histories(){

        $data =  DB::table('transaction as t')
            ->where('t.transaction_for','saving')
            ->where('t.transactable_id',$this->id)
            ->select("t.*",DB::raw("MONTH(date) as `month` "),DB::raw("YEAR(date) as `year` "))
            ->orderBy('date')
            ->get()->toArray();

            $collection = collect($data);

            return $grouped = $collection->groupBy(['year','month']);
    }


    public static function get_total_diposit_in_range($saving_id,$from,$to){
        $from = date("Y-m-d", strtotime($from));
        $to = date("Y-m-d", strtotime($to));
        $tatal_diposit_amount = Transaction::where('transactable_id',$saving_id)->where('transaction_for','saving')->where('flag','deposit')->where('canculatable','yes')
        ->where(function($q) use($from,$to){
            if($from){
                $q->where(DB::raw('DATE(date)'),'>=',$from);
            }
            if($to){
                $q->where(DB::raw('DATE(date)'),'<=',$to);
            }
        })
        ->sum('amount');

        return  $tatal_diposit_amount;

    }


}
