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

    public static function balance($wallet='office',$from=null,$to=null){

        $totalCreadit  = Transaction::where('type','income')->where('wallet',$wallet)
        ->where(function($q) use($from,$to){
            if($from){
                $q->where(DB::raw('DATE(date)'),'>=',$from);
            }
            if($to){
                $q->where(DB::raw('DATE(date)'),'<=',$to);
            }
        })
        ->where('status','approved')->where('canculatable','yes')->sum('amount');
        $totalDebit  = Transaction::where('type','expense')->where('wallet',$wallet)->where('canculatable','yes')
        ->where(function($q) use($from,$to){
            if($from){
                $q->where(DB::raw('DATE(date)'),'>=',$from);
            }
            if($to){
                $q->where(DB::raw('DATE(date)'),'<=',$to);
            }
        })
        ->where('status','!=','declined')
            ->sum('amount');

        $balance = $totalCreadit-$totalDebit;
        return $balance;

    }
}
