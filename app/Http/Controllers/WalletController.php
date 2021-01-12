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
     function __construct()
    {
        $this->middleware('permission:balance-list', ['only' => ['balance']]);
        $this->middleware('permission:balance-transfer-from', ['only' => ['transfer','transfer_submit']]);
    }


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



        if($request->from=='office'){
            if($request->to=='bank'){
                $from_head = TransactionHead::where('slug','bank_deposit_expense')->first();
            }else{
                $from_head = TransactionHead::where('slug','today_to_cashier_expense')->first();
            }

            if(!$from_head){
                return back()->withError('Related head didn\'t found!');
            }

        }elseif($request->to =='office' ){
            if($request->from=='bank'){
                $to_head = TransactionHead::where('slug','bank_withdraw_income')->first();
            }else{
                $to_head = TransactionHead::where('slug','today_from_cashier_income')->first();
            }

            if(!$to_head){
                return back()->withError('Related head didn\'t found!');
            }

        }

        //debit
        $deduct = new Transaction();
        $deduct->txn_id = uniqid();
        $deduct->type = 'expense';
        $deduct->wallet = $request->from;
        $deduct->head_id = $from_head->id??0;
        $deduct->note = $request->note;
        $deduct->date = $request->date;
        $deduct->amount = NumberConverter::bn2en($request->amount);
        $deduct->added_by = Auth::user()->id;
        $deduct->admin_status ='approved';
        $deduct->manager_status = 'approved';
        if($request->from=='bank' || $request->to=='bank')
            $deduct->bank_id = $request->bank_id;

        $deduct->status = 'approved';
        $deduct->canculatable = 'yes';
        $deduct->save();



        //credit
        $credit = new Transaction();
        $credit->txn_id = uniqid();
        $credit->type = 'income';
        $credit->wallet = $request->to;
        $credit->head_id = $to_head->id??0;
        $credit->note = $request->note;
        $credit->date = $request->date;
        $credit->amount = NumberConverter::bn2en($request->amount);
        $credit->added_by = Auth::user()->id;
        $credit->canculatable = 'yes';
        if($request->to=='bank')
            $deduct->bank_id = $request->bank_id;
        $credit->admin_status ='approved';
        $credit->manager_status = 'approved';
        $credit->status = 'approved';
        $credit->save();

        if ($request->invoice)
        {
            if($request->from=='office')
                return redirect('transaction-invoice/'.$deduct->txn_id);
            elseif($request->to=='office')
                return redirect('transaction-invoice/'.$credit->txn_id);
            else
                return redirect('transaction-invoice/'.$credit->txn_id);
        }

        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে');

    }
}
