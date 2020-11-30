<?php

namespace App\Http\Controllers;

use App\NumberConverter;
use App\Transaction;
use App\TransactionHead;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    //

    public function balance(){
        $office = Wallet::balance('office');
        $cashier = Wallet::balance('cashier');
        $bank = Wallet::balance('bank');
        return view('admin.wallet.balance',compact('office','cashier','bank'));
    }

    public function transfer($from='office'){
        $balance = Wallet::balance($from);

        return view('admin.wallet.transfer',compact('balance','from'));
    }

    public function transfer_submit(Request $request){
        $this->validate($request,[
            'amount'=>'required',
            'to'=>'required',
            'from'=>'required',
        ]);

        $amount = NumberConverter::bn2en($request->amount);

        $balance = Wallet::balance($request->from);
        if($balance < $amount){
            return back()->withErrors('  আপনার এই ব্যালেন্স এ যথেষ্ট পরিমান টাকা নেই!');
        }



        //debit
        $deduct = new Transaction();
        $deduct->txn_id = uniqid();
        $deduct->type = 'expense';
        $deduct->wallet = $request->from;
        $deduct->head_id = $request->head_id??0;
        $deduct->note = $request->note;
        $deduct->date = $request->date;
        $deduct->amount = NumberConverter::bn2en($request->amount);
        $deduct->added_by = Auth::user()->id;
        $deduct->admin_status ='approved';
        $deduct->manager_status = 'approved';
        $deduct->status = 'approved';
        $deduct->save();



        //credit
        $deduct = new Transaction();
        $deduct->txn_id = uniqid();
        $deduct->type = 'income';
        $deduct->wallet = $request->to;
        $deduct->head_id = $request->head_id??0;
        $deduct->note = $request->note;
        $deduct->date = $request->date;
        $deduct->amount = NumberConverter::bn2en($request->amount);
        $deduct->added_by = Auth::user()->id;
        $deduct->admin_status ='approved';
        $deduct->manager_status = 'approved';
        $deduct->status = 'approved';
        $deduct->save();

        if ($request->invoice)
        {
            $user = Auth::user();
            $date =  $request->date;
            $head = TransactionHead::find($request->head_id);
            if ($head->slug=='addmission_fee_income') { $admission_fee = NumberConverter::bn2en($request->amount); }else{$admission_fee=0;}
            if ($head->slug=='bank_profit_income') { $bank_profit = NumberConverter::bn2en($request->amount); }else{$bank_profit=0;}
            if ($head->slug=='other_income') { $others = NumberConverter::bn2en($request->amount); }else{$others=0;}
            if ($head->slug=='fine_income') { $fine = NumberConverter::bn2en($request->amount); }else{$fine=0;}
            if ($head->slug=='bank_withdraw_income') { $bank_withdrawal = NumberConverter::bn2en($request->amount); }else{$bank_withdrawal=0;}
            return view('admin/invoice',compact('user','date','admission_fee','bank_profit','others','fine','bank_withdrawal'));
        }
        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে');

    }
}
