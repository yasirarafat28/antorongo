<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TransactionHead;
use App\Transaction;
use App\NumberConverter;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    //



    public function create(Request $request)
    {
        $parents = TransactionHead::with('childs')->where('parent',0)->where('type','expense')->get();

        return view('admin/expense/add',compact('parents'));

    }
    public function store(Request $request)
    {
        $expense = new Transaction();
        $expense->txn_id = uniqid();
        $expense->type = 'expense';
        $expense->head_id = $request->head_id;
        $expense->note = $request->note;
        $expense->date = $request->date;
        $expense->amount = NumberConverter::bn2en($request->amount);
        $expense->added_by = Auth::user()->id;
        $expense->admin_status ='approved';
        $expense->manager_status = 'approved';
        $expense->status = 'approved';
        $expense->save();
        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে');

    }
    public function update(Request $request,$id)
    {
        $expense = Transaction::find($id);
        $expense->head_id = $request->head_id;
        $expense->note = $request->note;
        $expense->date = $request->date;
        $expense->amount = NumberConverter::bn2en($request->amount);
        $expense->save();
        return back()->withSuccess('সফলভাবে সেভ করা হয়েছে');

    }
    public function destroy(Request $request,$id)
    {

        $meeting = Transaction::destroy($id);
        return back()->withSuccess('সফলভাবে ডিলিট  করা হয়েছে');

    }
    public function index(Request $request)
    {

        $transactions = Transaction::with('head')->where(function ($q) use ($request){
            $q->where('type','expense');
            if ($request->has('from') && $request->from) {
                $from = date("Y-m-d", strtotime($request->from));
                $q->where('date', '>=',  $from);

            }
            if ($request->has('to') && $request->to) {

                $to = date("Y-m-d", strtotime($request->to));
                $q->where('date', '<=',  $to);

            }

        })->paginate(25);
        return view('admin/expense/list',compact('transactions'));

    }
}
