<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalletController extends Controller
{
    //

    public function balance(){
        return view('admin.wallet.balance');
    }
}
