<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\TransactionHead;

class TransactionController extends Controller
{
    //


    public function TransactionByHead(Request $request)
    {
        $transactions = Transaction::where(function ($q) use ($request){
            if ($request->has('from') && $request->from) {
                $from = date("Y-m-d", strtotime($request->from));
                $q->where('date', '>=',  $from);

            }
            if ($request->has('head_id') && $request->head_id) {
                $q->where('head_id',  $request->head_id);

            }
            if ($request->has('to') && $request->to) {

                $to = date("Y-m-d", strtotime($request->to));
                $q->where('date', '<=',  $to);

            }

        })->get();


        $parents = TransactionHead::with('childs')->where('parent',0)->get();

        return view('admin/TransactionByHead',compact('transactions','parents'));
    }
}
