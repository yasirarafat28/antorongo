<?php

namespace App\Http\Controllers;

use App\NumberConverter;
use Illuminate\Http\Request;
use App\Transaction;
use App\TransactionHead;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    // function __construct()
    // {
    //     $this->middleware('permission:transaction-list', ['only' => ['index']]);
    //     $this->middleware('permission:transaction-create', ['only' => ['create','store']]);
    //     $this->middleware('permission:transaction-edit', ['only' => ['edit','update']]);
    //     $this->middleware('permission:transaction-show', ['only' => ['show']]);
    //     $this->middleware('permission:transaction-delete', ['only' => ['destroy']]);
    // }


    public function index(Request $request)
    {
        $transactions = Transaction::where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $from = date("Y-m-d", strtotime($request->from));
                $q->where(DB::raw('DATE(date)'),'>=',$from);

            }
            if ($request->has('head_id') && $request->head_id) {
                $q->where('head_id',  $request->head_id);

            }
            if ($request->has('wallet') && $request->wallet) {
                $q->where('wallet',  $request->wallet);

            }
            if ($request->has('to') && $request->to) {

                $to = date("Y-m-d", strtotime($request->to));
                $q->where(DB::raw('DATE(date)'),'<=',$to);

            }

        })->get();


        $parents = TransactionHead::with('childs')->where('parent',0)->get();

        return view('admin.transactions.index',compact('transactions','parents'));
    }

    public function create(){

    }
    public function store(Request $request){

    }
    public function edit($id){

        $transaction = Transaction::find($id);
        return view('admin.transactions.edit',compact('transaction'));

    }
    public function update(Request $request,$id){
        $this->validate($request,[
            'amount'=>'required',
            'date'=>'required',
        ]);
        $transaction = Transaction::find($id);
        //$income->head_id = $request->head_id;
        $transaction->note = $request->note;
        $transaction->date = $request->date;
        $transaction->amount = NumberConverter::bn2en($request->amount);
        $transaction->save();


        if ($request->invoice)
        {
            return redirect('transaction-invoice/'.$transaction->txn_id);
        }



        return back()->withSuccess('সফলভাবে পরিবরতন করা হয়েছে!');


    }
    public function destroy(Request $request,$id){

        Transaction::destroy($id);


        return back()->withSuccess('সফলভাবে মুছে ফেলা হয়েছে!');
    }
}
