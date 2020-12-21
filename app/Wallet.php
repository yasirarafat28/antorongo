<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Wallet extends Model
{
    //

    const OFFICE    = 'office';
    const CASHIER    = 'cashier';
    const BANK    = 'bank';

    public static function balance($wallet='office',$from=null,$to=null,$bank_id=0){

        $totalCreadit  = Transaction::where('type','income')->where('wallet',$wallet)
        ->where(function($q) use($from,$to,$wallet,$bank_id){
            if($from){
                $q->where(DB::raw('DATE(date)'),'>=',$from);
            }
            if($to){
                $q->where(DB::raw('DATE(date)'),'<=',$to);
            }
            if($wallet=='bank' && $bank_id){
                $q->where('bank_id',$bank_id);
            }
        })
        ->where('status','approved')->where('canculatable','yes')->sum('amount');
        $totalDebit  = Transaction::where('type','expense')->where('wallet',$wallet)->where('canculatable','yes')
        ->where(function($q) use($from,$to,$wallet,$bank_id){
            if($from){
                $q->where(DB::raw('DATE(date)'),'>=',$from);
            }
            if($to){
                $q->where(DB::raw('DATE(date)'),'<=',$to);
            }
            if($wallet=='bank' && $bank_id){
                $q->where('bank_id',$bank_id);
            }
        })
        ->where('status','!=','declined')
            ->sum('amount');

        $balance = $totalCreadit-$totalDebit;
        return $balance;

    }
}
