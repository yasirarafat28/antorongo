<?php

namespace App\Http\Controllers;

use App\NumberConverter;
use App\Transaction;
use App\TransactionHead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    //

    public function create(Request $request)
    {
        $parents = TransactionHead::with('childs')->where('parent',0)->where('type','income')->get();

        return view('admin/income/add',compact('parents'));

    }
    public function store(Request $request)
    {
        $income = new Transaction();
        $income->txn_id = uniqid();
        $income->type = 'income';
        $income->head_id = $request->head_id;
        $income->note = $request->note;
        $income->date = $request->date;
        $income->amount = NumberConverter::bn2en($request->amount);
        $income->added_by = Auth::user()->id;
        $income->admin_status ='approved';
        $income->manager_status = 'approved';
        $income->status = 'approved';
        $income->save();

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
    public function update(Request $request,$id)
    {
        $income = Transaction::find($id);
        $income->head_id = $request->head_id;
        $income->note = $request->note;
        $income->date = $request->date;
        $income->amount = NumberConverter::bn2en($request->amount);
        $income->save();

        
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
    public function destroy(Request $request,$id)
    {

        $meeting = Transaction::destroy($id);
        return back()->withSuccess('সফলভাবে ডিলিট  করা হয়েছে');

    }
    public function index(Request $request)
    {

        $parents = TransactionHead::with('childs')->where('parent',0)->where('type','income')->get();

        $transactions = Transaction::with('head')->where(function ($q) use ($request){
            $q->where('type','income');
            if ($request->has('from') && $request->from) {
                $from = date("Y-m-d", strtotime($request->from));
                $q->where('date', '>=',  $from);

            }
            if ($request->has('to') && $request->to) {

                $to = date("Y-m-d", strtotime($request->to));
                $q->where('date', '<=',  $to);

            }

        })->get();
        return view('admin/income/list',compact('transactions','parents'));

    }
}
