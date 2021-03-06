<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Loan;
use App\LoanTransaction;
use Auth;
use App\NumberConverter;
use Illuminate\Support\Facades\DB;

class CollectionController extends Controller
{
    //

    public function Collect(Request $request)
    {


        if ($request->has('q')) {

            $query = $request->q;
            $loan = Loan::with('user','PersonDepositors','PropertyDepositors','OrnamentDepositors')->where('unique_id',$request->q)->first();
        }
        else{
            $loan ='';
            $query = '';
        }

        if($loan){
            $transactions = LoanTransaction::with('user','receiver')->where('loan_id',$loan->id)->orderBy('id','DESC')->get();
        }else{
            $transactions = '';

        }
        return view('admin/loan/collection-collect',compact('query','loan','transactions'));
    }

    public function CollectSubmit(Request $request)
    {

        $this->validate($request,
            [
                'amount' => 'required',
                'date' => 'required',
            ]
        );


        $transaction = new LoanTransaction();
        $transaction->txn_id = uniqid();
        $transaction->loan_id = $request->loan_id;
        $transaction->user_id = $request->user_id;
        $transaction->received_by = Auth::user()->id;
        $transaction->type = 'collect';
        $transaction->incoming = NumberConverter::bn2en($request->amount);
        $transaction->note = $request->note;
        $transaction->date = $request->date;
        $transaction->status = 'approved';
        $transaction->manager_status = 'approved';
        $transaction->admin_status = 'approved';
        $transaction->save();

        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে');

    }

    public function Report(Request $request)
    {

        $transactions = LoanTransaction::with('user','receiver','loans')->where(function ($q) use ($request){
            $q->where('type','collect');
            if ($request->has('from') && $request->from) {
                $from = date("Y-m-d", strtotime($request->from));
                $q->where(DB::raw('DATE(date)'),'>=',$from);

            }
            if ($request->has('to') && $request->to) {

                $to = date("Y-m-d", strtotime($request->to));
                $q->where(DB::raw('DATE(date)'),'<=',$to);

            }

        });
        if(isset($request->limit) && $request->limit=='-1'){
            $transactions = $transactions->paginate($transactions->count());
        }else{
            $transactions = $transactions->paginate(25);
        }
        return view('admin/loan/collection-report',compact('transactions'));
    }
}
