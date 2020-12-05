<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    //

    const OFFICE    = 'office';
    const CASHIER    = 'cashier';
    const BANK    = 'bank';

    public static function balance($wallet='office'){

        $totalCreadit  = Transaction::where('type','income')->where('wallet',$wallet)
            ->where('status','approved')->where('canculatable','yes')->sum('amount');
        $totalDebit  = Transaction::where('type','expense')->where('wallet',$wallet)->where('canculatable','yes')->where('status','!=','declined')
            ->sum('amount');

        $balance = $totalCreadit-$totalDebit;
        return $balance;

    }
}
