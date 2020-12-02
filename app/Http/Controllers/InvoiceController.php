<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function transaction_invoice($txn_id=''){
        $transaction = Transaction::where('txn_id',$txn_id)->first();

        return view('invoice.transaction-invoice',compact('transaction'));

    }
}
