<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransactionHead;
use App\Transaction;
use App\NumberConverter;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    // function __construct()
    // {
    //     $this->middleware('permission:expense-list', ['only' => ['index']]);
    //     $this->middleware('permission:expense-create', ['only' => ['create','store']]);
    //     $this->middleware('permission:expense-edit', ['only' => ['update']]);
    //     $this->middleware('permission:expense-delete', ['only' => ['destroy']]);
    // }



    public function create(Request $request)
    {
        $parents = TransactionHead::with('childs')->where('parent',0)->where('type','expense')->where('system_managable','no')->get();


        $members = User::where('role','member')->orderBy('name','ASC')->get();
        return view('admin/expense/add',compact('parents','members'));

    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'amount'=>'required',
            'head_id'=>'required',
            'date'=>'required',
        ]);

        $expense = new Transaction();
        $expense->txn_id = uniqid();
        $expense->type = 'expense';
        $expense->head_id = $request->head_id;
        $expense->user_id = $request->user_id??0;
        $expense->note = $request->note;
        $expense->date = $request->date;
        $expense->amount = NumberConverter::bn2en($request->amount);
        $expense->added_by = Auth::user()->id;
        $expense->admin_status ='approved';
        $expense->manager_status = 'approved';
        $expense->status = 'approved';
        $expense->save();


        if ($request->invoice)
        {
            return redirect('transaction-invoice/'.$expense->txn_id);
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
        $expense = Transaction::find($id);
        $expense->head_id = $request->head_id;
        if($request->user_id)
            $expense->user_id = $request->user_id??0;
        $expense->note = $request->note;
        $expense->date = $request->date;
        $expense->amount = NumberConverter::bn2en($request->amount);
        $expense->save();



        if ($request->invoice)
        {
            return redirect('transaction-invoice/'.$expense->txn_id);
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



        $parents = TransactionHead::with('childs')->where('parent',0)->where('type','expense')->get();

        $transactions = Transaction::with('head')->where(function ($q) use ($request){
            $q->where('type','expense');


            if ($request->has('head_id') && $request->head_id) {

                $q->where('head_id',$request->head_id);

            }
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
            $transactions = $transactions->orderBy('date','DESC')->paginate($transactions->count());
        }else{
            $transactions = $transactions->orderBy('date','DESC')->paginate(25);
        }



        $total = Transaction::where('canculatable','yes')->where(function ($q) use ($request){
            $q->where('type','expense');
            if ($request->has('head_id') && $request->head_id) {

                $q->where('head_id',$request->head_id);

            }
            if ($request->has('from') && $request->from) {
                $from = date("Y-m-d", strtotime($request->from));
                $q->where(DB::raw('DATE(date)'),'>=',$from);

            }
            if ($request->has('to') && $request->to) {

                $to = date("Y-m-d", strtotime($request->to));

                $q->where(DB::raw('DATE(date)'),'<=',$to);

            }

        })->sum('amount');
        return view('admin/expense/list',compact('transactions','total','parents'));

    }
}
