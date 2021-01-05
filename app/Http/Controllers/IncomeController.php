<?php

namespace App\Http\Controllers;

use App\NumberConverter;
use App\Transaction;
use App\TransactionHead;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IncomeController extends Controller
{
    //  function __construct()
    // {
    //     $this->middleware('permission:income-list', ['only' => ['index']]);
    //     $this->middleware('permission:income-create', ['only' => ['create','store']]);
    //     $this->middleware('permission:income-edit', ['only' => ['update']]);
    //     $this->middleware('permission:income-delete', ['only' => ['destroy']]);
    // }

    public function create(Request $request)
    {

        $members = User::where('role','member')->orderBy('name','ASC')->get();
        $parents = TransactionHead::with('childs')->where('parent',0)->where('type','income')->where('system_managable','no')->get();

        return view('admin/income/add',compact('parents','members'));

    }
    public function store(Request $request)
    {

        $this->validate($request,[
            'amount'=>'required',
            'head_id'=>'required',
            'date'=>'required',
        ]);

        $income = new Transaction();
        $income->txn_id = uniqid();
        $income->type = 'income';
        $income->head_id = $request->head_id;
        $income->user_id = $request->user_id??0;
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
            return redirect('transaction-invoice/'.$income->txn_id);
        }
        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে');

    }
    public function update(Request $request,$id)
    {



        $this->validate($request,[
            'amount'=>'required',
            'head_id'=>'required',
            'date'=>'required',
        ]);


        $income = Transaction::find($id);
        $income->head_id = $request->head_id;
        $income->user_id = $request->user_id??0;
        $income->note = $request->note;
        $income->date = $request->date;
        $income->amount = NumberConverter::bn2en($request->amount);
        $income->save();



        if ($request->invoice)
        {
            return redirect('transaction-invoice/'.$income->txn_id);
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

        $transactions = Transaction::with('head')->where('canculatable','yes')->where(function ($q) use ($request){
            $q->where('type','income');
            if ($request->has('from') && $request->from) {
                $from = date("Y-m-d", strtotime($request->from));

                $q->where(DB::raw('DATE(date)'),'<=',$from);

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


        $total = Transaction::where('canculatable','yes')->where(function ($q) use ($request){
            $q->where('type','income');
            if ($request->has('from') && $request->from) {
                $from = date("Y-m-d", strtotime($request->from));
                $q->where(DB::raw('DATE(date)'),'<=',$from);

            }
            if ($request->has('to') && $request->to) {

                $to = date("Y-m-d", strtotime($request->to));
                $q->where(DB::raw('DATE(date)'),'<=',$to);

            }

        })->sum('amount');


        return view('admin/income/list',compact('transactions','parents','total'));

    }
}
